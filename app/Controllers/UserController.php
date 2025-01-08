<?php

namespace App\Controllers;

use Core\Controller;

class UserController extends Controller
{
	public function profile($id)
	{
		$this->render('user/profile', ['userId' => $id]);
	}
	
	public function edit($id)
	{
		echo "Editing user with ID: $id";
	}
	
	public function store()
	{
		echo "Storing new user!";
	}
	
	public function update($id)
	{
		echo "Updating user with ID: $id";
	}
	
	public function destroy($id)
	{
		echo "Deleting user with ID: $id";
	}
}
