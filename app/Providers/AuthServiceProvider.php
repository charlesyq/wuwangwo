<?php namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\Auth\Contracts\Auth',
            'App\Services\Auth\AuthProvider'
        );
    }
}