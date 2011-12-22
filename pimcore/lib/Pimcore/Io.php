<?php
class Pimcore_Io {

    private static $context;

    public function fopen($filename, $mode, $use_include_path = false) {
        return fopen($filename, $mode, $use_include_path, self::getContext());
    }

    public function mkdir($pathname, $mode = 0777,  $recursive = false) {
        return mkdir($pathname, $mode,  $recursive, self::getContext());
    }

    public function rmdir($dirname) {
        return rmdir($dirname, self::getContext());
    }

    public function filesize($filename) {
        return filesize($filename);
    }

    public function unlink($file) {
        return unlink($file, self::getContext());
    }

    public function file_get_contents($filename, $use_include_path = false) {
        return file_get_contents($filename, $use_include_path, self::getContext());
    }

    public function isFile($filename) {
        return is_file($filename);
    }

    public function isDir($dir) {
        return is_dir($dir);
    }

    public function isReadable($file) {
        return is_readable($file);
    }

    public function file_put_contents($filename, $data, $flags = 0) {
        return file_put_contents($filename, $data, $flags, self::getContext());
    }

    public static function setContext($context) {
        self::$context = $context;
    }

    public function readfile($filename, $use_include_path=0) {
        return readfile($filename, $use_include_path);
    }

    public function scandir($string, $sorting = null) {
        return scandir($string, $sorting, self::getContext());
    }

    public function rscandir($string) {
        return rscandir($string);
    }

    public static function getContext() {
        if(!self::$context)
            self::$context = stream_context_create();

        return self::$context;
    }

}