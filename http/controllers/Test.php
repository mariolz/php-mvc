<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 0:39
 */
namespace http\controllers;
class Test extends controller
{
    function mytestAction()
    {
        //echo "hello";
        //var_dump(func_get_args());
        $this->loadModel('http\models\Test');
        //$res = $this->model->find(2);
        //$this->model->table('test')->where("name=www");
        //$obj = $this->model;
        $res = $this->model->table('')->where('id<>1',function(){

            $this->where(' name="wwww"');
            $this->where(' id=2');

        })->orwhere(function(){
            $this->where(' name="eeee"');
            $this->orwhere(' id=3');


        })->get($this->model->getSql());
var_dump($this->model->getSql());die;
        $this->assign("test","ssss");
        $this->assign("myname","hhh");
        $this->assign('memners',array(1,2,3));
        $this->display('index');
    }
    function mytest3Action()
    {
        $this->assign("test","mytest3Action");
        $this->assign("myname","hello");
        $this->assign('memners',array('a'=>1,'b'=>'2','c'=>3));
        $this->display('index');
    }
}