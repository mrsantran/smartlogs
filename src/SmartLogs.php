<?php

namespace SanTran\SmartLogs;

use Illuminate\Support\Facades\Request;

class SmartLogs
{
    private $logApt = null;
    private $logOpt = null;
    private $user_id = null;
    private $client_ip = null;
    private $path_info = null;

    public function __construct()
    {
        $this->logOpt = new OptLog();
        $this->logApt = new AppLog();
    }

    public function startLog($params = "START")
    {
        $this->appendParams($params);
        $this->log("info", $params);
    }

    public function finishLog($params = "FINISH")
    {
        $this->appendParams($params);
        $this->log("info", $params);
    }

    public function appInfo($params)
    {
        $this->appendParams($params);
        $this->log("info", $params);
    }

    public function appDebug($params)
    {
        $this->appendParams($params);
        $this->log("debug", $params);
    }

    public function appError($params)
    {
        $this->appendParams($params);
        $this->log("error", $params);
    }

    public function appWarning($params)
    {
        $this->appendParams($params);
        $this->log("warning", $params);
    }

    private function log($level, $params)
    {
        $this->logApt->{strtolower($level)}($params);
    }

    public function optLog($params)
    {
        $this->appendParams($params, true);
        $this->logOpt->log($params);
    }

    private function getInfo()
    {
        $user = Request::user();
        $this->client_ip = Request::getClientIp();
        $this->path_info = Request::getPathInfo();
        $this->user_id = ($user) ? $user->id : "";
    }

    private function appendParams(&$params, $is_option = false)
    {
        if (is_array($params)) {
            $params = Ultilities::jsonJapan($params);
        }
        $this->getInfo();
        if ($is_option) {
            $params = $this->client_ip . "," .
                    "USER_ID:" . $this->user_id . "," .
                    $this->path_info . "," . $params;
        } else {
            $params = "[OPERATION]," . $this->client_ip . "," .
                    "USER_ID:" . $this->user_id . "," .
                    $this->path_info . "," . $params;
        }
    }

}
