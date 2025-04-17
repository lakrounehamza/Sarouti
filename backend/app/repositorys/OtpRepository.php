<?php

namespace App\Repositorys;

use App\Contracts\OtpRepositoryInterface;
use App\Models\Otp;
class OtpRepository implements OtpRepositoryInterface
{
    public function createOtp(int $userId, string $code)
    {
        return Otp::create([
            'user_id' => $userId,
            'code' => $code,
        ]);
    }
    public function getOtpByUserId(int $userId)
    {
        return Otp::where('user_id', $userId)->first();
    }
    public function deleteOtp(int $userId)
    {
        $otp = Otp::where('user_id', $userId)->first();
        if ($otp) {
            $otp->delete();
        }
    }
}
