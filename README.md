Laravel 5 SmartLogs
======================

[![Total Downloads](https://img.shields.io/packagist/dt/santran/smartlogs.svg)](https://packagist.org/packages/santran/smartlogs)

Log look like
![preview](https://cloud.githubusercontent.com/assets/21286108/20433981/78479a96-add8-11e6-82c2-64bdc96fbc9b.png)

-----
The best Log for Laravel 5.2.x and above. **Install with composer**. 

Install (Laravel)
-----------------
Install via composer
```
composer require santran/smartlogs:dev-master
```

Add Service Provider to `config/app.php` in `providers` section
```php
SanTran\SmartLogs\SmartLogsServiceProvider::class,
```

Add Facade to `config/app.php` in `aliases` section:
```php 
'SmartLogs' => SanTran\SmartLogs\SmartLogsFacade::class,
```

Publish config file, open console and enter bellow command:
```php
php artisan vendor:publish
```
Config file 'smartlogs.php' will be copy to config/smartlogs.php, you can change any config on that file for SmartLogs
- 'log_path'         : Path to save file log
- 'log'              : Log daily or single file
- 'log_option_on'    : Enable/Disable Option Log
- 'log_level_enable' : Level of logs (Have four Level 'DEBUG', 'INFO', 'WARNING', 'ERROR')
- 'log_file_name'    : Name of file log

How to use ?
Open your Controller or any where you want to write log.
Add this line on above file, remember after 'namespace ...' keywork:
```php
use SmartLogs;
```
Call to write log on your function:
```php
SmartLogs::startLog($params)  : To write START log ($params is optional - Default is "START")

SmartLogs::finishLog($params)  : To write FINISH log ($params is optional - Default is "FINISH")

SmartLogs::appInfo($params)  : To write Information log ($params can be String or Array)

SmartLogs::appDebug($params)  : To write Debug log ($params can be String or Array)

SmartLogs::appWarning($params)  : To write Warning log ($params can be String or Array)

SmartLogs::appError($params)  : To write Error log ($params can be String or Array)

SmartLogs::optLog($params)  : To write Option log ($params can be String or Array)

SmartLogs::logRequest()     : To write Option log with all Request params
```

Features: 
- Update auto log lastest sql command
- And more...

Any Q/A, Please contact to me.
Skype: santd86
Email: santran686@gmail.com
