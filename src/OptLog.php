<?php

namespace SanTran\SmartLogs;

use SanTran\SmartLogs\Ultilities;

class OptLog
{

    private $dateFormat = "Y/m/d H:i:s";
    private $output = "%datetime%,%message%\n";
    private $logger = null;

    /**
     * Init class custom write log for report
     * @param string $filename
     * @param string $dateFormat
     * @param string $output
     */
    public function __construct($filename = null, $dateFormat = null, $output = null)
    {
        $dateFormat = $dateFormat? : $this->dateFormat;
        $output = $output? : $this->output;
        $filename = config('smartlogs.log_path') . "/" . ($filename? : config('smartlogs.log_file_name'));
        if (config('smartlogs.log') === 'daily') {
            $filename .= date("-Y-m-d");
        }
        $filename .= ".log";
        $formatter = new \Monolog\Formatter\LineFormatter($output, $dateFormat, false, true);
        $stream = new \Monolog\Handler\StreamHandler($filename);
        $firephp = new \Monolog\Handler\FirePHPHandler();
        $stream->setFormatter($formatter);
        $this->logger = new \Monolog\Logger("santran_smartlogs_option_logging");
        $this->logger->pushHandler($stream);
        $this->logger->pushHandler($firephp);
    }

    /**
     * Write Log INFO Level
     */
    public function log($message)
    {
        if ($this->checkCanWrite()) {
            $msg = Ultilities::jsonJapan($message);
            $this->logger->log("info", is_array($message) ? $msg : $message);
        }
    }

    /**
     * Check level can be write to log file with setting
     *
     * @param  string $level
     * @return boolean
     */
    private function checkCanWrite()
    {
        $result = false;
        if (config('smartlogs.log_option_on')) {
            $result = true;
        }
        return $result;
    }
}
