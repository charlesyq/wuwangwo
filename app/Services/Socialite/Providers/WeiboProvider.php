<?php namespace App\Services\Socialite\Providers;

use App\Services\Socialite\AbstractProvider;
use App\Services\Socialite\Contracts\Provider;
use App\Services\Socialite\User;
use SaeTClientV2;

require_once base_path() . '/lib/libweibo/saetv2.ex.class.php';

class WeiboProvider extends AbstractProvider implements Provider {

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

        $sdkApi = new SaeTClientV2($this->clientId, $this->clientSecret, $accessToken);

        $userInfo = $sdkApi->show_user_by_id($openId);

        if(isset($userInfo['error_code'])){
            throw new SocialiteApiException("getUserDetails failed", 0, null, $userInfo);
        }

        $user = new User();
        $user->id = $userInfo['id'];
        $user->nickname = $userInfo['name'];
        $user->avatar = $userInfo['avatar_large'];
        $user->gender = $userInfo['gender'] == 'm' ? User::GENDER_MALE : User::GENDER_FEMALE;

        return $user;
    }
}