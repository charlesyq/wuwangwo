<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Token extends Model {
    public static function authToken($userId, $ttl=2592000) { // 30 days
        $token = Token::where('user_id', '=', $userId)->first();
        if (!$token) {
            $token = new Token();
            $token->user_id = $userId;
        }

        $token->refresh($ttl);
        $token->save();

        return $token;
    }

    public function refresh($ttl) {
        $this->token = Str::random(20);
        $this->expires_at = date('Y-m-d H:i:s', time() + $ttl);
    }

    public function isExpired() {
        return strtotime($this->expires_at) < time();
    }

    public static function userWithToken($token)
    {
        $model = Token::where('token', '=', $token)->first();
        if (!$model) {
            return null;
        }

        return User::find($model->user_id);
    }
} 