<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\Auth\Contracts\Auth;
use App\Services\Authenticator;
use App\Services\Registrar;
use App\Services\Socialite\SocialiteManager;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class DebugController extends Controller
{

    public function getIndex(Request $request, Auth $auth)
    {
        $openId = '6F584D4F79C4C959F7E9DDD53F65F147';
        $accessToken = 'EA90A9944050ED0468ACE5D21E56CEE3';
        $provider = 'qq';

        $request->merge([
            'openId' => $openId,
            'accessToken' => $accessToken,
            'provider' => $provider
        ]);

        $app = Application::getInstance();
        $socialiteManager = new SocialiteManager($app);
        $register = new Registrar();
        $auth = new Authenticator($socialiteManager, $register);

        $res = $auth->auth($provider, $openId);

        var_dump($res);
    }

}
