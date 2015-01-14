<?php namespace App\Services\Socialite;

use Illuminate\Support\Manager;

class SocialiteManager extends Manager implements Contracts\Factory {
    private $supportedProviders = ['qq', 'weibo', 'weixin', 'gx'];

    public function getDefaultDriver()
    {
        return 'gx';
    }

    /**
     * @param string $driver
     * @return mixed
     */
    public function with($driver)
    {
        if (!in_array($driver, $this->supportedProviders)) {
            throw new \InvalidArgumentException("sns provider $driver not support");
        }

        return $this->driver($driver);
    }

    /**
     * Build an OAuth 2 provider instance.
     *
     * @param  string  $provider
     * @param  array  $config
     * @return \App\Services\Socialite\AbstractProvider
     */
    public function buildProvider($provider, $config)
    {
        return new $provider(
            $this->app['request'], $config['client_id'],
            $config['client_secret'], $config['redirect']
        );
    }

    protected function createQqDriver()
    {
        $config = $this->app['config']['services.qq'];

        return $this->buildProvider(
            'App\Services\Socialite\Providers\QqProvider', $config
        );
    }

    protected function createWeiboDriver()
    {
        $config = $this->app['config']['services.weibo'];

        return $this->buildProvider(
            'App\Services\Socialite\Providers\WeiboProvider', $config
        );
    }

    protected function createWeixinDriver()
    {
        $config = $this->app['config']['services.weixin'];

        return $this->buildProvider(
            'App\Services\Socialite\Providers\WeixinProvider', $config
        );
    }

    protected function createGxDriver()
    {
        $config = $this->app['config']['services.gxoauth'];

        return $this->buildProvider(
            'App\Services\Socialite\Providers\GxProvider', $config
        );
    }

}