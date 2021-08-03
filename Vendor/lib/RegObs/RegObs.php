<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 2:34
 */
namespace Vendor\lib\RegObs;
use IFS\Obs\Obs;
use Vendor\lib\regProxy\regProxy;

class RegObs implements Obs {
    function handler($obj)
    {
        //var_dump((new $obj));die;
        // TODO: Implement handler() method.
        //(new $obj)->mytest();die;
        $proxy = new regProxy();
        $proxy->register($obj,(new $obj));
    }
}