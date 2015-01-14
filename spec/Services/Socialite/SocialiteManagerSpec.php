<?php

namespace spec\App\Services\Socialite;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SocialiteManagerSpec extends ObjectBehavior
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
        $this->shouldHaveType('App\Services\Socialite\SocialiteManager');
    }

    public function it_throw_exception_if_provider_not_support()
    {
        $this->shouldThrow('\InvalidArgumentException')->during('with', array('foo'));
    }

    public function it_return_qq_provider()
    {
        $this->with('qq')->shouldHaveType('App\Services\Socialite\Providers\QqProvider');
    }

//    public function it_return_gx_provider()
//    {
//        $this->with('gx')->shouldHaveType('App\Services\Socialite\GxProvider');
//    }
//
//    public function it_return_user_when_auth_gx_user()
//    {
//        $request = Request::create('foo', 'GET', ['state' => 'state', 'code' => 'code']);
//
//        //$this->with('gx')->
//    }
}
