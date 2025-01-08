<?php

use JetBrains\PhpStorm\NoReturn;


// Hàm require file với đường dẫn tương đối
function baseRequire($path): void
{
	var_dump($path);
	require_once __DIR__ . '/../' . $path;
}

// Hàm chuyển hướng URL
#[NoReturn] function redirect($url): void
{
	header("Location: $url");
	exit;
}

// Hàm dump dữ liệu và dừng chương trình (debug nhanh)
#[NoReturn] function dd($data): void
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	exit;
}

// Hàm lọc dữ liệu đầu vào an toàn
function sanitizeInput($input): string
{
	return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Chuyển hướng nếu không được phép
#[NoReturn] function abort($code = 403)
{
	http_response_code($code);
	echo "$code - Access Denied.";
	exit;
}
