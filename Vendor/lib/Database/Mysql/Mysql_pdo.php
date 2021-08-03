<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/31
 * Time: 15:58
 */

namespace Vendor\lib\Database\Mysql;
use IFS\DB\DB;
class Mysql_pdo implements DB
{
    private static $dsn  = '';
    private static $user = '';
    private static $pass = '';
    private static $db   = '';
    private static $dbh = null;
    private $sql = '';
    private static $instance = null;
    private  $table  ='';
    private $left ='';
    private $right = '';
    private function __construct($cfg){
        //print_r($cfg['dnms']);die;
        self::$dsn  = $cfg['dnms'].':host='.$cfg['host'].';dbname='.$cfg['db'];
        //var_dump(self::$dsn);die;
        self::$user = $cfg['user'];
        self::$pass = $cfg['pass'];
        self::$db   = $cfg['db'];

        $this->connect();
    }
    private function __clone(){}
    function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->table = $value;
        //var_dump($this->table);
    }

    static function getInstance($cfg)
    {
        if(null == self::$instance)
        {

            self::$instance = new Mysql_pdo($cfg);

        }

        return self::$instance;
    }

    public  function connect()
    {
        try {
            if(null ==self::$dbh )
            {
                self::$dbh = new \PDO(self::$dsn, self::$user, self::$pass); //初始化一个PDO对象
            }
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
       // return self::$dbh;
    }
    function table($table)
    {

        $this->table =  !empty($table)?$table:$this->table;
        $res = $this->getColumnsByTable($this->table);
        $this->sql .= "select ".$this->getColumnString($res)." from ".$this->table." where 1 ";
        return $this;
    }

    function find($id)
    {
        return $this->getOne($id);
    }
    function getColumnsByTable($table)
    {
        $sql = "select column_name from information_schema.COLUMNS where TABLE_SCHEMA=? and table_name=?";
        //var_dump($sql);die;
        $bParams[1] = self::$db;
        $bParams[2] = $table;
        /*array_push($this->bParams,self::$db);
        array_push($this->bParams,$table);*/
        return $this->query($sql,$bParams);
    }
    function getPreparedStmt($sql)
    {
        return self::$dbh->prepare($sql);
    }
    function getColumnString(array $columns):string
    {

        return implode(',',array_column($columns,'COLUMN_NAME'));
        //var_dump($res);

    }
    function get($sql)
    {


        return $this->query($sql);
    }
    function getOne($id)
    {
        $res = $this->getColumnsByTable($this->table);
        $columns = $this->getColumnString($res);
        //print_r($columns);die;

        $str = "select ".$this->getColumnString($res)." from ".$this->table." where 1 ";
        $str .= " and id=?";
        $bParams[1] = $id;
        return $this->queryOne($str,$bParams);
    }
    function  queryOne($sql,$bParams=[])
    {
        // TODO: Implement query() method.
        try {
            $stmt = $this->getPreparedStmt($sql);
            foreach ($bParams as $k=>$v)
            {

                $stmt->bindValue($k,$v);
            }
            $stmt->execute();
            return $stmt->fetch();


            $dbh = null;
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        //默认这个不是长连接，如果需要数据库长连接，需要最后加一个参数：array(PDO::ATTR_PERSISTENT => true) 变成这样：
        //$db = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    }
    function  query($sql,$bParams=[])
    {
        // TODO: Implement query() method.
        try {
            $stmt = $this->getPreparedStmt($sql);
            if(!empty($bParams))
            {
                foreach ($bParams as $k=>$v)
                {

                    $stmt->bindValue($k,$v);
                }
            }
            $stmt->execute();
            return $stmt->fetchAll();


            $dbh = null;
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        //默认这个不是长连接，如果需要数据库长连接，需要最后加一个参数：array(PDO::ATTR_PERSISTENT => true) 变成这样：
        //$db = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    }
    function getSql()
    {

        return $this->sql;
    }
    function where(...$sql)
    {
        $sqls = '';

        $c = null;
       // var_dump($sql);die;
        foreach ($sql as $k=>$v)
        {
            //var_dump($v,$v instanceof Closure);
            if(is_string($v))
            {
                $sqls .=" and $v";
                //var_dump($sqls,$a);
            }else {


                $c = $v->bindTo(new Mysql_where(),new Mysql_where());
                $c();
                //var_dump($GLOBALS['or']);


            }


        }
        $where='';

        $flag = ' and ';
        if (isset($GLOBALS['and']) && isset($GLOBALS['or']))
        {
            $where .= " (".implode(" or ",$GLOBALS['or'])." or ".implode(" and ",$GLOBALS['and']).")";
        }else if(isset($GLOBALS['and']) && !isset($GLOBALS['or'])){
            $where .= " (".implode(" and ",$GLOBALS['and']).")";
        }else if(!isset($GLOBALS['and']) && isset($GLOBALS['or'])) {
            $where .= " (".implode(" or ",$GLOBALS['or']).")";
        }
        //var_dump($and);die;

        $this->sql .= $sqls.$flag.$where;
        unset($GLOBALS['or']);
        unset($GLOBALS['and']);
        return $this;
    }
    function orwhere(...$sql)
    {
        $sqls = '';

        $c = null;
        // var_dump($sql);die;
        foreach ($sql as $k=>$v)
        {
            //var_dump($v,$v instanceof Closure);
            if(is_string($v))
            {
                $sqls .=" or $v";
                //var_dump($sqls,$a);
            }else {


                $c = $v->bindTo(new Mysql_where(),new Mysql_where());
                $c();
                //var_dump($GLOBALS['or']);
               // $GLOBALS['or'];

            }
        }
        $where='';
        $flag = ' or ';
        if (isset($GLOBALS['and']) && isset($GLOBALS['or']))
        {
            $where .= " (".implode(" or ",$GLOBALS['or'])." or ".implode(" and ",$GLOBALS['and']).")";
        }else if(isset($GLOBALS['and']) && !isset($GLOBALS['or'])){
            $where .= " (".implode(" and ",$GLOBALS['and']).")";
        }else if(!isset($GLOBALS['and']) && isset($GLOBALS['or'])) {
            $where .= " (".implode(" or ",$GLOBALS['or']).")";
        }
        $this->sql .= $sqls.$flag.$where;
        unset($GLOBALS['or']);
        unset($GLOBALS['and']);
        return $this;
    }

}