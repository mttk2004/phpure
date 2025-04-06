<?php

/**
 * The configuration file for the storage system.
 *
 * This file contains the configuration for the storage system.
 */

return [
  /*
    |--------------------------------------------------------------------------
    | Root Storage Directory
    |--------------------------------------------------------------------------
    |
    | The path to the root storage directory for uploaded files
    |
    */
  'uploads_path' => BASE_PATH . '/storage/uploads',

  /*
    |--------------------------------------------------------------------------
    | Default Permissions
    |--------------------------------------------------------------------------
    |
    | Default permissions when creating directories
    |
    */
  'permissions' => [
    'dir' => 0755,    // Permissions for directories
    'file' => 0644,   // Permissions for files
  ],

  /*
    |--------------------------------------------------------------------------
    | Allowed Extensions
    |--------------------------------------------------------------------------
    |
    | List of allowed file extensions for uploads
    |
    */
  'allowed_extensions' => [
    'jpg',
    'jpeg',
    'png',
    'gif',
    'webp',
    'svg',  // Image
    'pdf',
    'doc',
    'docx',
    'xls',
    'xlsx',
    'txt',  // Document
    'zip',
    'rar',
    '7z',  // Compression
    'mp3',
    'mp4',
    'wav',
    'ogg',
    'avi',
    'webm',  // Media
  ],

  /*
    |--------------------------------------------------------------------------
    | Maximum Size
    |--------------------------------------------------------------------------
    |
    | Maximum size of uploaded files (bytes)
    | Default: 10MB = 10 * 1024 * 1024
    |
    */
  'max_size' => 10 * 1024 * 1024,  // 10MB
];
