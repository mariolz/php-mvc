<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 3:10
 */
namespace Vendor\lib;
use IFS\Register\Register;
class registerObj implements Register {
    public static $objs = [];
    public static function register($key, $val)
    {
        self::$objs[$key] = $val;
    }
}