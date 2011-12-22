<?php

class Logger_Shared {
    public static function log ($message,$code=Zend_Log::INFO) {
        Logger::log($message,$code);
    }

    public static function emergency ($m, $l = null) {
        Logger::log($m,Zend_Log::EMERG);
    }

    public static function emerg ($m, $l = null) {
        Logger::emergency($m);
    }

    public static function critical ($m, $l = null) {
        Logger::log($m,Zend_Log::CRIT);
    }

    public static function crit ($m, $l = null) {
        Logger::critical($m);
    }

    public static function error ($m, $l = null) {
        Logger::log($m,Zend_Log::ERR);
    }

    public static function err ($m, $l = null) {
        Logger::error($m);
    }

    public static function alert ($m, $l = null) {
        Logger::log($m,Zend_Log::ALERT);
    }

    public static function warning ($m, $l = null) {
        Logger::log($m,Zend_Log::WARN);
    }

    public static function warn ($m, $l = null) {
        Logger::warning($m);
    }

    public static function notice ($m, $l = null) {
        Logger::log($m,Zend_Log::NOTICE);
    }

    public static function info ($m, $l = null) {
        Logger::log($m,Zend_Log::INFO);
    }

    public static function debug ($m, $l = null) {
        Logger::log($m,Zend_Log::DEBUG);
    }
}