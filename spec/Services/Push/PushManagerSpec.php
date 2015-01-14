<?php

namespace spec\App\Services\Push;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PushManagerSpec extends ObjectBehavior
{
    public function createApplication()
    {
        $app = require __DIR__.'/../../../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    function let()
    {
        $this->beConstructedWith($this->createApplication());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('App\Services\Push\PushManager');
    }

    function it_create_getui_driver()
    {
        $this->createGetuiDriver()->shouldHaveType('App\Services\Push\GetuiPushProvider');
    }
}
