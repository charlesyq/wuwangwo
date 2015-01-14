<?php namespace App\Services\Push\Contracts;


interface Factory {
    /**
     * Get an Push provider implementation.
     *
     * @param  string  $driver
     * @return \App\Services\Push\Contracts\Provider
     */
    public function driver($driver = null);

} 