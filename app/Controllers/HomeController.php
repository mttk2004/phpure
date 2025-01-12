<?php

namespace App\Controllers;

use Core\Controller;
use Core\Logger;

class HomeController extends Controller
{
    public function index()
    {
        $this->render('home');
    }
}
