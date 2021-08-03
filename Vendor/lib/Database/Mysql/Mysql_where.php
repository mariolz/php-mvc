<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/31
 * Time: 15:58
 */

namespace Vendor\lib\Database\Mysql;
class Mysql_where
{
    private $sql ='';
    function __construct(){

    }
    function orwhere()
    {

        $arr = func_get_args();
        $farr = [];
        //sunset($GLOBALS['or']);
        foreach ($arr as $k=>$v)
        {
            //$this->sql .=" and ".$v;
            // var_dump($this->sql);

            $GLOBALS['or'][$v] = $v;
        }
    }
    function where()
    {

        $arr = func_get_args();
        $farr = [];
        //unset($GLOBALS['and']);
        foreach ($arr as $k=>$v)
        {
            //$this->sql .=" and ".$v;
           // var_dump($this->sql);
            $GLOBALS['and'][$v] = $v;
        }

    }

    function replaceString($search,$replace,$content,$limit=-1){
        if(is_array($search)){
            foreach ($search as $k=>$v){
                $search[$k]='`'.preg_quote($search[$k],'`').'`';
            }
        }else{
            $search='`'.preg_quote($search,'`').'`';
        }
        //把描述去掉
        $content=preg_replace("/alt=([^ >]+)/is",'',$content);
        return preg_replace($search,$replace,$content,$limit);
    }

}