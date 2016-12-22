<?php

namespace SanTran\SmartLogs;

use SanTran\SmartLogs\Ultilities;

class AppLog
{

    private $dateFormats = "Y/m/d H:i:s";
    private $outputs = "%datetime%,%level_name%,%message% %context% %extra%\n";
    private $loggers = null;

    /**
     * Init class custom write log for report
     * @param string $filenames
     * @param string $dateFormats
     * @param string $outputs
     */
    public function __construct($filenames = null, $dateFormats = null, $outputs = null)
    {
        $dateFormats = $dateFormats ?: $this->dateFormats;
        $outputs = $outputs ?: $this->outputs;
        $filenames = config('smartlogs.log_path') . "/" . ($filenames ?: config('smartlogs.log_file_name'));
        if (config('smartlogs.log') === 'daily') {
            $filenames .= date("-Y-m-d");
        }
        $filenames .= ".log";
        $formatters = new \Monolog\Formatter\LineFormatter($outputs, $dateFormats, false, true);
        $streams = new \Monolog\Handler\StreamHandler($filenames);
        $streams->setFormatter($formatters);
        $this->loggers = new \Monolog\Logger("santran_smartlogs_application_logging");
        $this->loggers->pushHandler($streams);
    }

    /**
     * Write Log INFO Level
     * @param array $message
     */
    public function info($message)
    {
        if ($this->checkCanWriteLog("INFO")) {
            $msg = Ultilities::jsonJapan($message);
            $this->loggers->addInfo(is_array($message) ? $msg : $message);
        }
    }

    /**
     * Write Log ERROR Level
     *
     * @param type $message
     */
    public function error($message)
    {
        if ($this->checkCanWriteLog("ERROR")) {
            $msg = Ultilities::jsonJapan($message);
            $this->loggers->addError(is_array($message) ? $msg : $message);
        }
    }

    /**
     * Write Log DEBUG Level
     * @param type $message
     */
    public function debug($message)
    {
        if ($this->checkCanWriteLog("DEBUG")) {
            $msg = Ultilities::jsonJapan($message);
            $this->loggers->addDebug(is_array($message) ? $msg : $message);
        }
    }

    /**
     * Write Log WARNING Level
     * @param type $message
     */
    public function warning($message)
    {
        if ($this->checkCanWriteLog("WARNING")) {
            $msg = Ultilities::jsonJapan($message);
            $this->loggers->addWarning(is_array($message) ? $msg : $message);
        }
    }

    /**
     * Write Log CRITICAL Level
     * @param type $message
     */
    public function critical($message)
    {
        if ($this->checkCanWriteLog("CRITICAL")) {
            $msg = Ultilities::jsonJapan($message);
            $this->loggers->addCritical(is_array($message) ? $msg : $message);
        }
    }

    /**
     * Write Log ALERT Level
     * @param type $message
     */
    public function alert($message)
    {
        if ($this->checkCanWriteLog("ALERT")) {
            $msg = Ultilities::jsonJapan($message);
            $this->loggers->addAlert(is_array($message) ? $msg : $message);
        }
    }

    /**
     * Write Log EMERGENCY Level
     * @param type    $message
     * @param boolean $is_array
     */
    public function emergency($message)
    {
        if ($this->checkCanWriteLog("EMERGENCY")) {
            $msg = Ultilities::jsonJapan($message);
            $this->loggers->addEmergency(is_array($message) ? $msg : $message);
        }
    }

    /**
     * Check level can be write to log file with setting
     *
     * @param  string $level
     * @return boolean
     */
    private function checkCanWriteLog($level)
    {
        $result = false;
        $list_level = config('smartlogs.log_level_list');
        $current_level = config('smartlogs.log_level_enable');
        if (array_search($current_level, $list_level) <= array_search($level, $list_level)) {
            $result = true;
        }
        return $result;
    }

}
