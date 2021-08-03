<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/31
 * Time: 15:47
 */
namespace IFS\DB;
interface DB {
    function connect();
    function  query($sql);
    function where(...$str);
    static function getInstance($cfg);
    function find($id);
}