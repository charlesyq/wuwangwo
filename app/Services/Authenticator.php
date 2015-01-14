<?php namespace App\Services;

use App\OpenUser;
use App\Token;
use App\User;
use App\Services\Socialite\Contracts\Factory as SocialiteFactory;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Authenticator {
    const TOKEN_TTL = 86400;

    /**
     * @var SocialiteFactory
     */
    private $socialite;

    /**
     * @var RegistrarContract
     */
    private $registrar;

    function __construct(SocialiteFactory $socialite, RegistrarContract $registrar)
    {
        $this->socialite = $socialite;
        $this->registrar = $registrar;
    }

    public function auth($provider, $openId)
    {
        $openUser = OpenUser::where(['provider' => $provider, 'open_id' => $openId])->first();
        if (! $openUser) {
            $openUserInfo = $this->socialite->driver($provider)->user();

            $user = $this->registerUser(
                $provider,
                $openId,
                $openUserInfo->getNickname(),
                $openUserInfo->getGender(),
                $openUserInfo->getAvatar()
            );

            $openUser = new OpenUser;
            $openUser->provider = $provider;
            $openUser->open_id = $openId;
            $openUser->user_id = $user->id;
            $openUser->save();
        } else {
            $user = User::findOrFail($openUser->user_id);
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        $ttl = self::TOKEN_TTL;
        $token = $this->loginUser($user->id, $ttl);

        return [
            'user' => array(
                'id' => $user->id,
                'nickname' => $user->nickname,
                'gender' => $user->gender,
                'avatar' => $user->avatar,
            ),
            'token' => $token,
            'token_expires_at' => time() + $ttl,
        ];
    }

    public function registerUser($provider, $openId, $nickname, $gender, $avatar)
    {
        $validator = $this->registrar->validator([
            'provider' => $provider,
            'openId' => $openId,
            'nickname' => $nickname,
            'avatar' => $avatar,
            'gender' => $gender
        ]);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->getMessageBag());
        }

        return $this->registrar->create([
            'nickname' => $nickname,
            'gender' => $gender,
            'avatar' => $avatar
        ]);
    }

    public function loginUser($userId, $ttl)
    {
        return Token::authToken($userId, $ttl)->token;
    }
} 