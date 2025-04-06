<?php

/**
 * The configuration file for the database connection.
 *
 * This file contains the configuration for the database connection.
 */

return [
  /*
    |--------------------------------------------------------------------------
    | Default Database Connection
    |--------------------------------------------------------------------------
    |
    | This is the default connection used by the application, you can change
    | this value to use a different connection.
    |
    */
  'default' => getenv('DB_CONNECTION') ?? 'mysql',

  /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | This is the information for each database connection in the application.
    | You can set up multiple connections.
    |
    */
  'connections' => [
    'mysql' => [
      'adapter' => getenv('DB_ADAPTER') ?? 'mysql',
      'host' => getenv('DB_HOST') ?? 'localhost',
      'port' => getenv('DB_PORT') ?? 3306,
      'database' => getenv('DB_NAME') ?? 'phpure',
      'username' => getenv('DB_USER') ?? 'root',
      'password' => getenv('DB_PASS') ?? '',
      'charset' => getenv('DB_CHARSET') ?? 'utf8mb4',
      'collation' => getenv('DB_COLLATION') ?? 'utf8mb4_unicode_ci',
      'prefix' => getenv('DB_PREFIX') ?? '',
    ],

    'sqlite' => [
      'adapter' => 'sqlite',
      'database' => getenv('DB_NAME') ?? BASE_PATH . '/database/database.sqlite',
    ],
  ],
];
