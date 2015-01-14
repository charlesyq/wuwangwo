<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SnsLoginRequest;
use App\Services\Socialite\GxSocialiteManager;
use Laravel\Socialite\SocialiteManager;

class SnsAuthController extends Controller {

    public function __construct(GxSocialiteManager $socialite)
    {
        $this->socialite = $socialite;
    }

    public function postLogin(SnsLoginRequest $request)
    {
        $this->validate($request, array(
            'openId' => 'required',
            'openKey' => 'required',
            'platform' => 'required',
        ));

        $user = $this->socialite->with($request->get('platform'))->user();
    }
} 