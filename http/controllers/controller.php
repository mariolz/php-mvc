<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/31
 * Time: 18:12
 */
namespace http\controllers;
use Vendor\lib\templates;
class controller {
    protected  $model = null;
    private $templatesObj = null;
    function __construct()
    {
       // var_dump(get_class_methods(get_class()),get_class_methods(get_class($this)));
        $this->templatesObj = (new templates());
    }

    function loadModel($param)
    {
        $this->model = (new $param);
        return $this->model;
    }
    function display($name, ...$arguments)
    {


        $this->templatesObj->display($name, $arguments);
    }
    function assign($k,$v)
    {
        $this->templatesObj->assign($k,$v);
    }

}