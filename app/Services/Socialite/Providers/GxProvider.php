<?php namespace App\Services\Socialite\Providers;

use App\Services\Socialite\AbstractProvider;
use App\Services\Socialite\Contracts\Provider;
use App\Services\Socialite\User;

class GxProvider extends AbstractProvider implements Provider {

    /**
     * Get the User instance for the authenticated user.
     *
     * @return \App\Services\Socialite\User
     */
    public function user()
    {
        $user = new User();
        $user->id = $this->request->get('open_id');
        $user->nickname = "dummy nickname";
        $user->avatar = 'avatar';
        $user->gender = User::GENDER_FEMALE;

        return $user;
    }
}