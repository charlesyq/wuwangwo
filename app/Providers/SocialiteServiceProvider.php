<?php namespace App\Providers;

use App\Services\Socialite\SocialiteManager;
use Illuminate\Support\ServiceProvider;

class SocialiteServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('App\Services\Socialite\Contracts\Factory', function($app)
        {
            return new SocialiteManager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Services\Socialite\Contracts\Factory'];
    }
}