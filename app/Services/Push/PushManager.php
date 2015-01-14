<?php namespace App\Services\Push;

use App\Repositories\DeviceRepository;
use App\Services\Push\Providers\GetuiPushProvider;
use IGeTui;
use Illuminate\Support\Manager;
require_once base_path() . '/lib/getui/IGt.Push.php';

class PushManager extends Manager {

    public function createGetuiDriver(){
        $config = $this->app['config']['services.getui'];

        var_dump($config);
        $igt = new IGeTui($config['host'], $config['app_key'], $config['master_secret']);
        return new GetuiPushProvider($config, $igt, new DeviceRepository);
    }

    public function createGxpushDriver(){
        $config = $this->app['config']['services.gxpush'];

        return $this->buildProvider(
            'App\Services\Push\GxPushProvider', $config
        );
    }

    public function getDefaultDriver()
    {
        throw new \InvalidArgumentException("No Socialite driver was specified.");
    }
}