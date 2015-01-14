<?php namespace App\Services\Push\Contracts;


interface Provider {
    function pushNotification($userId, $title, $content, $badge=1);
} 