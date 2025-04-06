<?php

/**
 * The configuration file for the cache system.
 *
 * This file contains the configuration for the cache system.
 */

return [
  /*
    |--------------------------------------------------------------------------
    | Default Time
    |--------------------------------------------------------------------------
    |
    | The default time (minutes) that cache items will be stored
    |
    */
  'ttl' => 60,

  /*
    |--------------------------------------------------------------------------
    | Cache Directory
    |--------------------------------------------------------------------------
    |
    | The path to the cache directory of the application
    |
    */
  'path' => BASE_PATH . '/storage/cache',

  /*
    |--------------------------------------------------------------------------
    | Optimize Cache
    |--------------------------------------------------------------------------
    |
    | The settings related to optimizing the cache system
    |
    */
  'optimize' => [
    'auto_clean' => true,      // Automatically delete expired cache
    'cleanable' => true,       // Allow deleting cache
  ],
];
