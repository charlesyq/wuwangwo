<?php namespace App\Services\Socialite;

class SocialiteApiException extends \Exception {
    public $response;

    public function __construct($message = "", $code = 0, \Exception $previous = null, $response = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }
} 