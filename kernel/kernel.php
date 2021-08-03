<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/25
 * Time: 0:32
 */
namespace kernel;
use Vendor\lib\RegObserver\RegObserver;
use Vendor\lib\RegObs\RegObs;
use Vendor\lib\ManagerObserver\ManagerObserver;

class kernel
{
    private function __construct(){}
    private static $instance = null;
    private function __clone(){}

    static function initObserver($key)
    {
        $observer = new RegObserver();
        $obs      = new RegObs();
        $mg       = new ManagerObserver();
        if (is_array($key))
        {
            foreach ($key as $k=>$v)
            {
                $mg->add($v,$obs);
                $observer->notify($mg);
            }
        } else {
            $mg->add($key,$obs);
            $observer->notify($mg);
        }

    }

}

