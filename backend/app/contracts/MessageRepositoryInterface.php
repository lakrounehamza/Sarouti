<?php

namespace App\Contracts;

interface MessageRepositoryInterface
{
    public function createMessage();
    public function  deleteMessage();
    public function getAllMessagebyIduser();
}
