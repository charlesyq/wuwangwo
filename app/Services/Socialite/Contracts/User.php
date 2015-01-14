<?php namespace App\Services\Socialite\Contracts;


interface User {
    /**
     * Get the unique identifier for the user.
     *
     * @return string
     */
    public function getId();

    /**
     * Get the nickname / username for the user.
     *
     * @return string
     */
    public function getNickname();

    /**
     * Get the gender for the user.
     *
     * @return integer
     */
    public function getGender();

    /**
     * Get the avatar / image URL for the user.
     *
     * @return string
     */
    public function getAvatar();
} 