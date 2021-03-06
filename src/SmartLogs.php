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

    public function logRequest()
    {
        $params = [
            "type" => "REQUEST",
            "params" => Request::all()
        ];
        $this->appendParams($params);
        $this->log("info", $params);
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
        $write_log = false;
        if (config("smartlogs.log_condition")) {
            $list_users = config('smartlogs.list_user_id');
            $list_ip = config('smartlogs.list_ip');
            if (!config("smartlogs.log_reverse")) {
                if (in_array($this->client_ip, $list_ip) || in_array($this->user_id, $list_users)) {
                    $write_log = true;
                }
            } else {
                if (!in_array($this->client_ip, $list_ip) && !in_array($this->user_id, $list_users)) {
                    $write_log = true;
                }
            }
        } else {
            $write_log = true;
        }
        if ($write_log) {
            $this->logApt->{strtolower($level)}($params);
        }
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
        if (!$is_option) {
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
