<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 2:45
 */
namespace Vendor\lib\regProxy;
class regProxy  {
    function __call($func, $args)
    {
        // TODO: Implement registerObj() method.
        //$c = new registerObj();
        //var_dump($args);die;
        call_user_func_array(array('Vendor\lib\registerObj',$func),$args);
    }
}