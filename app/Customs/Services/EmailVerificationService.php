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
    public function sendVerificationEmail( $user)
    {
       Notification::send($user, new EmailVerificationNotification($this->generateVerificationLink($user->email)));
    }
    public function generateVerificationLink(String $email)
    {
        $chechToken = EmailVirification::where('email', $email)->first();
        if (!$chechToken) {
            // $chechToken->delete();
            $token =Str::uuid();
            $url = config('app.url') . '/api/verify-email/' . $token;
            $saveToken = EmailVirification::create([
                'email' => $email,
                'token' => $token,
                'email_expired_at' => now()->addMinutes(02),
            ]);
            if($saveToken) {
                return $url;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to save token'
                ], 500);
            }
        }
    }
    public function verifyEmail($token)
    {
        $emailVerification = EmailVirification::where('token', $token)->first();
        if (!$emailVerification) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token'
            ], 400);
        }
        if ($emailVerification->email_expired_at < now()) {
            return response()->json([
                'success' => false,
                'message' => 'Token expired'
            ], 400);
        }
        if ($emailVerification->email_verified_at) {
            return response()->json([
                'success' => false,
                'message' => 'Email already verified'
            ], 400);
        }

        $user = User::where('email', $emailVerification->email)->first();
        $user->update(['email_verified_at' => now()]);
        $emailVerification->delete();
        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully'
        ], 200);
    }
    public function verifyToken($token)
    {
        $emailVerification = EmailVirification::where('token', $token)->first();
        if (!$emailVerification) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token'
            ], 400);
        }
        if ($emailVerification->email_expired_at < now()) {
            return response()->json([
                'success' => false,
                'message' => 'Token expired'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'message' => 'Token is valid'
        ], 200);
    }
    public function  checkEmailVerification($user)
    {
        $emailVerification = EmailVirification::where('email', $user->email)->first();
        if ($emailVerification) {
            return response()->json([
                'success' => true,
                'message' => 'Email already verified'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Email not verified'
        ], 400);
    }
}
