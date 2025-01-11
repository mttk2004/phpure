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

function loadEnv(): void
{
	$envPath = BASE_PATH . '/.env';
	if (file_exists($envPath)) {
		$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		foreach ($lines as $line) {
			if (strpos(trim($line), '#') === 0) {
				continue;
			}
			[$key, $value] = explode('=', $line, 2);
			putenv(trim($key) . '=' . trim($value));
		}
	}
}

/**
 * Ném Exception khi điều kiện thỏa mãn
 * @throws Exception
 */
function throw_if(bool $condition, string $message): void
{
	if ($condition) {
		throw new \Exception($message);
	}
}
