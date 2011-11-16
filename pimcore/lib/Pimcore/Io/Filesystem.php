<?php

class Pimcore_Io_Filesystem {
    public static function fopen($filename, $mode) {
        return new Pimcore_Io_Resource($filename, $mode);
    }

    public static function flock($filename, $operation) {
        return flock($filename, $operation);
    }

    public static function mkdir($pathname, $mode = 0777,  $recursive = false) {
        return mkdir($pathname, $mode,  $recursive);
    }

    public static function rmdir($dirname) {
        return rmdir($dirname);
    }

    public static function unlink($file) {
        return unlink($file);
    }

    public static function file_get_contents($filename, $use_include_path = false, $offset = -1, int $maxlen) {

    }

    public static function setDiver($diver) {
        self::$diver = $diver;
    }
}