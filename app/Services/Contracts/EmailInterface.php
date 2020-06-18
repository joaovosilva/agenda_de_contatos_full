<?php

namespace App\Services\Contracts;

interface EmailInterface
{
    public function welcomeEmail($user);
    public function add(string $subject, string $body, string $recipientName, string $recipientEmail);
    public function sendMail();
}
