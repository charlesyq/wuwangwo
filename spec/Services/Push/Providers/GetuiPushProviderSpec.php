<?php

namespace spec\App\Services\Push\Providers;

use App\Device;
use App\Repositories\DeviceRepository;
use IGeTui;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

require_once __DIR__ . '/../../../../lib/getui/IGt.Push.php';

class GetuiPushProviderSpec extends LaravelObjectBehavior
{
    /**
     * @var IGeTui
     */
    private $igt;
    /**
     * @var DeviceRepository
     */
    private $repository;

    function let(IGeTui $igt, DeviceRepository $repository)
    {
        $this->igt = $igt;
        $this->repository = $repository;

        $config = [];
        $this->beConstructedWith($config, $igt, $repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('App\Services\Push\Providers\GetuiPushProvider');
    }

    function it_push_notification_to_ios()
    {
        $device = new Device();
        $device->os = 'ios7.0';
        $device->getui_clientid = '123';
        $device->uid = 1;

        $this->repository->getUserDevice(1)->willReturn($device);
        $this->igt->
        $this->pushNotification(1, 'title', 'content', 2);
    }
}
