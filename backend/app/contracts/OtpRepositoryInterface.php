<?php

namespace App\Contracts;

interface OtpRepositoryInterface
{
    public function createOtp(int $userId, string $code);

    public function getOtpByUserId(int $userId);

    public function deleteOtp(int $userId);

}
