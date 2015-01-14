<?php namespace App\Services\Auth\Contracts;


interface Auth {
    function id();
    function user();

    /**
     * @return boolean
     */
    function isLogin();
} 