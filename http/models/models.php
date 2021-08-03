<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/31
 * Time: 18:00
 */
namespace http\models;
use Vendor\lib\db;
class models
{
    private $table;
    private $cfg    = ['user'=>'mario','pass'=>'123456','host'=>'192.168.32.115','dnms'=>'mysql','db'=>'test','database'=>'Mysql','driven'=>'Mysql_pdo'];
    function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->table = $value;
    }
    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        //$this->cfg['table'] = $this->table;

        $obj = new db($this->cfg);
        $obj->table =$this->table;
        return call_user_func_array(array($obj,$name),$arguments);
    }

}