<?php

namespace App\Controllers;


use App\Models\UserModel;
use Core\Controller;


class UserController extends Controller
{
	public function index()
	{
		$user = UserModel::find(1);
				dd(UserModel::all());
		$profile = $user->profile();
		
		dd($profile);
	}
}
