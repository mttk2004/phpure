<?php

/**
 * Cấu hình kết nối database cho Phinx
 *
 * CHÚ Ý: ĐỪNG SỬA FILE NÀY.
 * NẾU CẦN THAY ĐỔI CẤU HÌNH, HÃY SỬA FILE .ENV
 */

const BASE_PATH = __DIR__;
require_once __DIR__ . '/utils/helpers.php';

// Load các biến môi trường từ file .env để sử dụng hàm getenv()
loadEnv();

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
		'production' => [
			'adapter' => getenv('DB_ADAPTER') ?? 'mysql',
			'host' => getenv('DB_HOST') ?? 'localhost',
			'name' => getenv('DB_NAME') ?? 'production_db',
			'user' => getenv('DB_USER') ?? 'root',
			'pass' => getenv('DB_PASS') ?? '',
			'port' => getenv('DB_PORT') ?? '3306',
			'charset' => getenv('DB_CHARSET') ?? 'utf8mb4',
		],
        'development' => [
            'adapter' => getenv('DB_ADAPTER') ?? 'mysql',
            'host' => getenv('DB_HOST') ?? 'localhost',
            'name' => getenv('DB_NAME') ?? 'development_db',
            'user' => getenv('DB_USER') ?? 'root',
            'pass' => getenv('DB_PASS') ?? '',
            'port' => getenv('DB_PORT') ?? '3306',
            'charset' => getenv('DB_CHARSET') ?? 'utf8mb4',
        ],
		'testing' => [
			'adapter' => getenv('DB_ADAPTER') ?? 'mysql',
			'host' => getenv('DB_HOST') ?? 'localhost',
			'name' => getenv('DB_NAME') ?? 'testing_db',
			'user' => getenv('DB_USER') ?? 'root',
			'pass' => getenv('DB_PASS') ?? '',
			'port' => getenv('DB_PORT') ?? '3306',
			'charset' => getenv('DB_CHARSET') ?? 'utf8mb4',
		],
    ],
    'version_order' => 'creation'
];
