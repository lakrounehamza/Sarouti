<?php

namespace App\Customs\Services;

use App\Models\EmailVirification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailVerificationNotification;
use  App\Models\User;
class EmailVerificationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function sendVerificationEmail(User $user)
    {
       Notification::send($user, new EmailVerificationNotification($this->generateVerificationLink($user->email)));
    }
    public function generateVerificationLink(String $email)
    {
        $chechToken = EmailVirification::where('email', $email)->first();
        if (!$chechToken) {
            $chechToken->delete();
            $token =Str::uuid();
            $url = config('app.url') . '/api/verify-email/' . $token;
            $saveToken = EmailVirification::create([
                'email' => $email,
                'token' => $token,
                'email_expired_at' => now()->addMinutes(02),
            ]);
            return $url;
        }
    }
}
