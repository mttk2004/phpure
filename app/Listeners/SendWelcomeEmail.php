<?php

namespace App\Listeners;

class SendWelcomeEmail
{
    public function handle(array $user): void
    {
        echo "Welcome email sent to {$user['email']}.\n";
        // TODO: Implement the logic to send the welcome email
    }
}
