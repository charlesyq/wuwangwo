<?php namespace App\Services\Socialite;

use Illuminate\Http\Request;
use App\Services\Socialite\Contracts\Provider as ProviderContract;

abstract class AbstractProvider implements ProviderContract {

    /**
     * The client ID.
     *
     * @var string
     */
    protected $clientId;

    /**
     * The client secret.
     *
     * @var string
     */
    protected $clientSecret;

    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = [];

    /**
     * The HTTP request instance.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new provider instance.
     *
     * @param  Request  $request
     * @param  string  $clientId
     * @param  string  $clientSecret
     * @param  string  $redirectUrl
     * @return void
     */
    public function __construct(Request $request, $clientId, $clientSecret, $redirectUrl)
    {
        $this->request = $request;
        $this->clientId = $clientId;
        $this->redirectUrl = $redirectUrl;
        $this->clientSecret = $clientSecret;
    }

} 