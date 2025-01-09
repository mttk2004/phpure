<?php

namespace App\Controllers;


use Core\Controller;
use App\Models\UserModel;
use Core\Database;


class UserController extends Controller
{
	protected UserModel $userModel;
	
	public function __construct()
	{
		$this->userModel = new UserModel();
	}
	
	// Lấy danh sách người dùng
	public function index()
	{
		$users = $this->userModel->all();
		$this->render('user/index', ['users' => $users]);
	}
	
	// Thêm người dùng mới
	public function store()
	{
		$this->userModel->create([
				'name' => 'John Doe',
				'email' => 'john@example.com',
		]);
		
		echo "User Added Successfully!";
	}
	
	// Cập nhật người dùng
	public function update()
	{
		$this->userModel->update(['name' => 'Jane Doe'], 1);
		echo "User Updated Successfully!";
	}
	
	// Xóa người dùng
	public function delete()
	{
		$this->userModel->delete(1);
		echo "User Deleted Successfully!";
	}
}
