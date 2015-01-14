<?php namespace App\Services\Auth;


use App\Services\Auth\Contracts\Auth;
use App\Token;
use Illuminate\Http\Request;

class AuthProvider implements Auth{

    /**
     * @var Request
     */
    private $request;
    private $user;

    function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = Token::userWithToken($request->get('token'));
    }


    function id()
    {
        return $this->user->id;
    }

    function user()
    {
        return $this->user;
    }

    /**
     * @return boolean
     */
    function isLogin()
    {
        return $this->user() != null;
    }
}