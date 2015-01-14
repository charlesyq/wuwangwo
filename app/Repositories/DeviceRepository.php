<?php namespace App\Repositories;

class DeviceRepository {
    function getUserDevice($userId)
    {
        return Device::where(['user_id' => $userId])->first();
    }
} 