<?php

/**
 * The configuration file for the paths.
 *
 * This file contains the definitions of the paths for the main directories of the application.
 */

return [
  /*
    |--------------------------------------------------------------------------
    | Application Directory
    |--------------------------------------------------------------------------
    |
    | The main directories of the application.
    |
    */
  'app' => BASE_PATH . '/app',

  /*
    |--------------------------------------------------------------------------
    | Public Directory
    |--------------------------------------------------------------------------
    |
    | The directory containing static resources that can be publicly accessed
    |
    */
  'public' => BASE_PATH . '/public',

  /*
    |--------------------------------------------------------------------------
    | Storage Directory
    |--------------------------------------------------------------------------
    |
    | The directory containing cache, logs, uploads,...
    |
    */
  'storage' => [
    'base' => BASE_PATH . '/storage',
    'cache' => BASE_PATH . '/storage/cache',
    'logs' => BASE_PATH . '/storage/logs',
    'uploads' => BASE_PATH . '/storage/uploads',
  ],

  /*
    |--------------------------------------------------------------------------
    | Resources Directory
    |--------------------------------------------------------------------------
    |
    | The directory containing the resources like views, css, js,...
    |
    */
  'resources' => [
    'base' => BASE_PATH . '/resources',
    'views' => BASE_PATH . '/resources/views',
    'css' => BASE_PATH . '/resources/css',
    'js' => BASE_PATH . '/resources/js',
  ],

  /*
    |--------------------------------------------------------------------------
    | Database Directory
    |--------------------------------------------------------------------------
    |
    | The directory containing migrations, seeds,...
    |
    */
  'database' => [
    'base' => BASE_PATH . '/database',
    'migrations' => BASE_PATH . '/database/migrations',
    'seeds' => BASE_PATH . '/database/seeds',
  ],
];
