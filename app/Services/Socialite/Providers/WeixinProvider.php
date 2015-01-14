<?php namespace App\Services\Socialite\Providers;

use App\Services\Socialite\AbstractProvider;
use App\Services\Socialite\Contracts\Provider;
use App\Services\Socialite\User;

class WeixinProvider extends AbstractProvider implements Provider {
    private $apiHost = 'https://api.weixin.qq.com';

    /**
     * Redirect the user to the authentication page for the provider.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect()
    {
        // TODO: Implement redirect() method.
    }

    /**
     * Get the User instance for the authenticated user.
     *
     * @throws SocialiteApiException
     * @return \Laravel\Socialite\Contracts\User
     */
    public function user()
    {
        $openId = $this->request->get('openId');
        $accessToken = $this->request->get('accessToken');

        $url = $this->apiHost . '/sns/userinfo?' . http_build_query(
                array(
                    'openid' => $openId,
                    'access_token' => $accessToken
                )
            );

        $userInfo = file_get_contents($url);

        if(isset($userInfo['errcode'])){
            throw new SocialiteApiException("getUserDetails failed", 0, null, $userInfo);
        }

        $user = new User();
        $user->id = $userInfo['openid'];
        $user->nickname = $userInfo['nickname'];
        $user->avatar = $userInfo['headimgurl'];
        $user->gender = $userInfo['sex'];

        return $user;
    }
}