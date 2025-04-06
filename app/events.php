<?php

use App\Listeners\SendWelcomeEmail;
use Core\Event;

// TODO: Define events here
Event::listen('user.registered', SendWelcomeEmail::class);
