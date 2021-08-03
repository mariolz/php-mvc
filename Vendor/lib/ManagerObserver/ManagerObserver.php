<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 2:38
 */
namespace Vendor\lib\ManagerObserver;
use IFS\Observermanager\Observermanager;
class  ManagerObserver implements Observermanager {
    public $observers = [];
    function add($key, $obs)
    {
        // TODO: Implement add() method.
        $this->observers[$key] = $obs;
    }
    function delete($key)
    {
        // TODO: Implement delete() method.
        unset($this->observers[$key]);
    }
}