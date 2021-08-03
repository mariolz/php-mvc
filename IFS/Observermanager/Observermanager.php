<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 0:42
 */
namespace IFS\Observermanager;
interface Observermanager {
    function add($key,$val);
    function delete($key);
}