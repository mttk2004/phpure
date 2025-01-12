<?php

use Core\Event;
use App\Listeners\SendWelcomeEmail;


// Đăng ký listener cho sự kiện "user.registered"
Event::listen('user.registered', SendWelcomeEmail::class);
