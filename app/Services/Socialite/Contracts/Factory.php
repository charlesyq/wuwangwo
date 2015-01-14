<?php namespace App\Services\Socialite\Contracts;


interface Factory {
    /**
     * Get an OAuth provider implementation.
     *
     * @param  string  $driver
     * @return \App\Services\Socialite\Contracts\Provider
     */
    public function driver($driver = null);

} 