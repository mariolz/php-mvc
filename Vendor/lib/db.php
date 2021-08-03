<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/31
 * Time: 16:43
 */
namespace Vendor\lib;
class db
{
    public $db = null;
    private $table = '';
    private $dbObj = null;
    function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->table = $value;
    }

    function __construct( $cfg)
    {
        $objS = "Vendor\lib\Database\\".$cfg['database']."\\".$cfg["driven"];
        $this->dbObj = call_user_func_array(array($objS,'getInstance'),array($cfg));

    }
    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        $this->dbObj->table = $this->table;
        return call_user_func_array(array($this->dbObj,$name),$arguments);
    }
}