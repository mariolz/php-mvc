<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 1:26
 */
   class MyAutoLoad {
        static  function doPrint($classname)
       {
           $classPath = str_replace("\\","/",$classname);
           if(is_file(ROOT.DIRECTORY_SEPARATOR.$classPath.".php"))
           {
               require_once (ROOT.DIRECTORY_SEPARATOR.$classPath.".php");
           }
       }
   }
   spl_autoload_register(array('MyAutoLoad','doPrint'));




