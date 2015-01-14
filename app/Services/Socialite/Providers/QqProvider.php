<?php namespace App\Services\Socialite\Providers;

use App\Services\Socialite\AbstractProvider;
use App\Services\Socialite\Contracts\Provider;
use App\Services\Socialite\SocialiteApiException;
use App\Services\Socialite\User;
use OpenApiV3;

require_once base_path() . '/lib/openApi/OpenApiV3.php';

class QqProvider extends AbstractProvider implements Provider {

    private $pf = 'qzone';

    /**
     * Get the User instance for the authenticated user.
     * @throws SocialiteApiException
     * @return \App\Services\Socialite\User
     */
    public function user()
    {
        $openId = $this->request->get('open_id');
        $accessToken = $this->request->get('access_token');

        $params = array(
            'openid' => $openId,
            'openkey' => $accessToken,
            'pf' => $this->pf,
        );

        $sdkApi = new OpenApiV3($this->clientId, $this->clientSecret);
        $sdkApi->setServerName('119.147.19.43');

        $userInfo = $sdkApi->api('/v3/user/get_info', $params, 'post');

        if($userInfo['ret'] != 0){
            throw new SocialiteApiException("getUserDetails failed", 0, null, $userInfo);
        }

        $user = new User();
        $user->id = $openId;
        $user->nickname = $userInfo['nickname'];
        $user->avatar = $userInfo['figureurl'];
        $user->gender = $userInfo['gender'] == '男' ? User::GENDER_MALE : User::GENDER_FEMALE;

        return $user;
    }
}
