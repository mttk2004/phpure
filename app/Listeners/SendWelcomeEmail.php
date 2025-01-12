<?php

namespace App\Listeners;


class SendWelcomeEmail
{
	public function handle(array $user): void
	{
		echo "Welcome email sent to {$user['email']}.\n";
		// Logic gửi email thực tế sẽ được đặt ở đây
	}
}
