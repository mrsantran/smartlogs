<?php

return [
    /*
      |--------------------------------------------------------------------------
      | List user will write log
      |--------------------------------------------------------------------------
     */
    'list_user_id' => [1, 2],
    /*
      |--------------------------------------------------------------------------
      | List IP will write log
      |--------------------------------------------------------------------------
     */
    'list_ip' => ['127.0.0.1', '::1'],
    /*
      | By default, file storage (in the storage folder) is used. Redis and PDO
      | can also be used. For PDO, run the package migrations first.
      |
     */
    'log_path' => storage_path('smartlogs'),
    /*
      | Here you may configure the log settings for your application. This gives
      | you a variety of powerful log handlers / formatters to utilize.
      |
      | Available Settings: "single", "daily", "syslog", "errorlog"
      |
     */
    'log' => 'daily',
    /*
      |--------------------------------------------------------------------------
      | Setting on/off write log Options
      |--------------------------------------------------------------------------
      | true: On
      | false: Off
      |--------------------------------------------------------------------------
     */
    'log_option_on' => true,
    /*
      |--------------------------------------------------------------------------
      | Set log LEVEL on application
      |--------------------------------------------------------------------------
      | DEBUG
      | INFO
      | WARNING
      | ERROR
      |--------------------------------------------------------------------------
     */
    'log_level_enable' => 'DEBUG',
    /*
      |--------------------------------------------------------------------------
      | Define list LEVEL log
      |--------------------------------------------------------------------------
      | DEBUG
      | INFO
      | WARNING
      | ERROR
      |--------------------------------------------------------------------------
     */
    'log_level_list' => ['DEBUG', 'INFO', 'WARNING', 'ERROR'],
    /*
      |--------------------------------------------------------------------------
      | Set Name for custom log file
      |--------------------------------------------------------------------------
     */
    'log_file_name' => 'application',
];
