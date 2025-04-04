<?php

namespace App\Customs\Services;

use App\Models\EmailVirification;
use Illuminate\Support\Str;
class EmailVerificationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function generateVerificationLink($email)
    {
        $chechToken = EmailVirification::where('email', $email)->first();
        if (!$chechToken) {
            $chechToken->delete();
            $token =Str::uuid();
            $url = config('app.url') . '/api/verify-email/' . $token;
            $saveToken = EmailVirification::create([
                'email' => $email,
                'token' => $token,
                'email_expired_at' => now()->addMinutes(30),
            ]);
            return $url;
        }
    }
}
