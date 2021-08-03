<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 21:05
 */
namespace IFS\Type;
interface Type
{
    static function Ints($param);
    static function Strings($param);
    static function Bools($param);
}