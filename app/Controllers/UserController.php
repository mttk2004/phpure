<?php

namespace App\Controllers;

use Core\Controller;
use Core\Validation;
use Respect\Validation\Validator as v;
use App\Models\UserModel;

class UserController extends Controller
{
	public function store()
	{
		// Dữ liệu đầu vào từ request
		$data = [
				'name' => $_POST['name'] ?? '',
				'email' => $_POST['email'] ?? '',
				'password' => $_POST['password'] ?? '',
				'password_confirmation' => $_POST['password_confirmation'] ?? '',
		];
		
		// Quy tắc kiểm tra
		$rules = [
				'name' => v::notEmpty()->length(3, 50),
				'email' => v::notEmpty()->email()->noWhitespace(),
				'password' => v::notEmpty()->length(6, null),
				'password_confirmation' => v::equals($data['password']),
		];
		
		// Thực hiện validation
		$validator = new Validation();
		if (!$validator->validate($data, $rules)) {
			// Trả về lỗi nếu validation thất bại
			$errors = $validator->errors();
			dd($errors);
			$this->render('user/error', ['errors' => $errors]);
		}
		
		// Lưu dữ liệu nếu hợp lệ
		$userModel = new UserModel();
		$userModel->create([
				'name' => $data['name'],
				'email' => $data['email'],
				'password' => password_hash($data['password'], PASSWORD_BCRYPT),
		]);
		
		echo "User Added Successfully!";
	}
}
