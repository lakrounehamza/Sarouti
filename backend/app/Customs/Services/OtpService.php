<?php

namespace App\Customs\Services;

use App\Models\Otp;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OtpNotification;

class OtpService
{
  
    public function sendOtpEmail($user)
    {
        $otpCode = $this->generateOtp();

        Notification::send($user, new OtpNotification($otpCode));

        Otp::create([
            'user_id' => $user->id,
            'code' => $otpCode,
        ]);
    }

    private function generateOtp(): int
    {
        return random_int(100000, 999999);
        
    }
}