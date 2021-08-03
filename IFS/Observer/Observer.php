<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 0:41
 */
namespace IFS\Observer;
interface Observer {
    function notify($value);

}