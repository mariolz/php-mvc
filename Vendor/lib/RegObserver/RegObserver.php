<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 1:12
 */
namespace Vendor\lib\RegObserver;
use IFS\Observer\Observer;
class RegObserver implements Observer {
    public function notify( $obs)
    {
        // TODO: Implement notify() method.
        $t = $obs->observers;
        foreach ($t as $k=>$v) {
            $v->handler($k);
        }
    }
}