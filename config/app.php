<?php

/**
 * The configuration file for the application.
 *
 * This file contains the core configuration for the application.
 */

return [
  /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value determines the name of the application. This name is used when
    | the framework needs to name the application in notifications or interfaces.
    |
    */
  'name' => getenv('APP_NAME') ?? 'PHPure',

  /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This configuration determines the environment in which the application is running. Common values include "production", "development", and "testing".
    |
    */
  'env' => getenv('APP_ENV') ?? 'development',

  /*
    |--------------------------------------------------------------------------
    | Debug Mode
    |--------------------------------------------------------------------------
    |
    | When debug mode is enabled, errors will be displayed in detail.
    | In the production environment, this feature should be disabled.
    |
    */
  'debug' => filter_var(getenv('APP_DEBUG') ?? true, FILTER_VALIDATE_BOOLEAN),

  /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Determines the default timezone for the application, used by date and time functions.
    |
    */
  'timezone' => getenv('APP_TIMEZONE') ?? 'Asia/Ho_Chi_Minh',

  /*
    |--------------------------------------------------------------------------
    | Application Encoding
    |--------------------------------------------------------------------------
    |
    | The default encoding used by the application when processing strings, passwords, etc.
    |
    */
  'encoding' => 'UTF-8',
];
