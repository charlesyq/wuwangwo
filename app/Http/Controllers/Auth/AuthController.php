<?php namespace App\Http\Controllers\Auth;

use App\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\Authenticator;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller {

    public function postLogin(Authenticator $auth, AuthRequest $request)
    {
        $provider = $request->get('provider');
        $openId = $request->get('open_id');
        $accessToken = $request->get('access_token');

        $result = $auth->auth($provider, $openId, $accessToken);
        return Response::json($result);
    }

    public function postLogout()
    {
        // expire the token
    }

    public function postRefresh()
    {
        // refresh token
    }

    private function loginUser($userId)
    {
    }

    private function registerUser($openUserInfo)
    {

    }

}
