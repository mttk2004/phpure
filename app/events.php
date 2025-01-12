<?php

use App\Listeners\SendWelcomeEmail;
use Core\Event;


// Đăng ký listener cho sự kiện "user.registered"
Event::listen('user.registered', [SendWelcomeEmail::class, 'handle']);
