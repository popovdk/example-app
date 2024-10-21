<?php

namespace App\Service;

use App\Models\VerifyCode;
use Nette\Utils\Random;

class UserService
{
    public function createVerifyCode($userId): string
    {
        $code = Random::generate('6', '0-9');

        VerifyCode::where('user_id', $userId)->delete();

        $verifyCode = VerifyCode::create([
            'code' => $code,
        ]);

        $verifyCode->user()->associate($userId);
        $verifyCode->save();

        return $code;
    }

    public function checkVerifyCode($userId, $code): bool
    {
        $verifyCode = VerifyCode::with(['user'])->where('user_id', $userId)->where('code', $code)->first();

        if (!$verifyCode) {
            return false;
        }

        $verifyCode->user->email_verified_at = now();
        $verifyCode->user->save();

        $verifyCode->delete();

        return true;
    }
}
