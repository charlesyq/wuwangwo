<?php namespace App\Services\Socialite\Contracts;


interface Provider {
    /**
     * Get the User instance for the authenticated user.
     *
     * @return \App\Services\Socialite\Contracts\User
     */
    public function user();

} 