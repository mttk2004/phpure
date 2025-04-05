<?php

/**
 * Cấu hình kết nối database cho Phinx
 *
 * CHÚ Ý: KHÔNG SỬA FILE NÀY.
 * NẾU CẦN THAY ĐỔI CẤU HÌNH, HÃY SỬA FILE .ENV HOẶC config/database.php
 */

// Load cấu hình database
$dbConfig = require_once __DIR__ . '/database.php';
$default = $dbConfig['default'];
$connections = $dbConfig['connections'];

return [
  'paths' => [
    'migrations' => '%%PHINX_CONFIG_DIR%%/../database/migrations',
    'seeds' => '%%PHINX_CONFIG_DIR%%/../database/seeds',
  ],
  'environments' => [
    'default_migration_table' => 'phinxlog',
    'default_environment' => getenv('APP_ENV') ?? 'development',
    'production' => [
      'adapter' => $connections['mysql']['adapter'],
      'host' => $connections['mysql']['host'],
      'name' => $connections['mysql']['database'],
      'user' => $connections['mysql']['username'],
      'pass' => $connections['mysql']['password'],
      'port' => $connections['mysql']['port'],
      'charset' => $connections['mysql']['charset'],
    ],
    'development' => [
      'adapter' => $connections['mysql']['adapter'],
      'host' => $connections['mysql']['host'],
      'name' => $connections['mysql']['database'],
      'user' => $connections['mysql']['username'],
      'pass' => $connections['mysql']['password'],
      'port' => $connections['mysql']['port'],
      'charset' => $connections['mysql']['charset'],
    ],
    'testing' => [
      'adapter' => $connections['mysql']['adapter'],
      'host' => $connections['mysql']['host'],
      'name' => $connections['mysql']['database'] . '_test',
      'user' => $connections['mysql']['username'],
      'pass' => $connections['mysql']['password'],
      'port' => $connections['mysql']['port'],
      'charset' => $connections['mysql']['charset'],
    ],
  ],
  'version_order' => 'creation',
];
