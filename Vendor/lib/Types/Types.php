<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 2:45
 */
namespace Vendor\lib\Types;
use \IFS\Type\Type;
class Types implements Type{
    public static function Ints($param)
    {
        // TODO: Implement isInt() method.
        return is_numeric($param);
    }
    public static function Strings($param)
    {
        // TODO: Implement isString() method.
        return is_bool($param);
    }
    public static function Bools($param)
    {
        // TODO: Implement isBool() method.
        switch ($param) {
            case "true":
            case "false":
            $param = (bool)$param;
            break;
        }
        return is_bool($param);
    }
}