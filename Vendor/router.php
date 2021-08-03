<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 17:19
 */
namespace Vendor;
use Vendor\lib\registerObj;
use kernel\kernel;
use Vendor\lib\Types\Types;
class router
{
    private static $ins=null;
    private static $objList = [];
    private static $controller;
    private static $method;
    private static $classPath;
    private static $methodPath;
    private function __construct(){}
    private function __clone(){}
    public static function getParams($reqUrl,$step)
    {
        for($i=0;$i<$step;$i++)
        {
            array_shift($reqUrl);
        }
        return $reqUrl;


    }
    static function patternUrl($patternUrl,$reqUrl)
    {
        $res = parse_url($patternUrl,PHP_URL_PATH);
        $patternUrl = explode("/",$res);
        $patternUrlParams = explode(',',trim(trim(self::getParams($patternUrl,3)[0],"{"),"}"));
        if($patternUrl[1] == self::$classPath )
        {
            if($patternUrl[2] == self::$methodPath  )
            {

            } else {
                print_r("路径与route中设置的格式不匹配");
                exit;
            }
        } else {
            echo '路径与route中设置的格式不匹配';
            exit;
        }
        $params = self::getParams($reqUrl,3);
        if(count($patternUrlParams) != count($params))
        {
            echo "参数个数不匹配";
            exit;
        }
        foreach ($patternUrlParams as $k=>$v)
        {
            //var_dump(Types::$v($params[$k]));
            if(!Types::$v($params[$k]))
            {
                echo '参数类型不匹配';
                exit;
            }
        }

        unset($params);
        unset($res);
        unset($patternUrl);
        unset($patternUrlParams);
    }
    static function route($url,$call)
    {
        $reqUrl = explode('/',$_SERVER['REQUEST_URI']);
        if(count($reqUrl)>0)
        {
            self::$classPath  = $reqUrl[1];
            self::$methodPath = $reqUrl[2]??"index";
        }

        $arr = explode('@',$call);
        self::$controller = $arr[0];
        self::$method     = $arr[1].'Action';
        unset($GLOBALS['controller']);
        unset($GLOBALS['method']);
        $GLOBALS['controller'] = self::$controller;
        $GLOBALS['method'] = self::$method;
        $params = self::getParams($reqUrl,3);
        $urls = explode('/',$url);
        $tpath = $urls[1].DIRECTORY_SEPARATOR.$urls[2];
        $calls[$tpath] = self::$method;
        $cc = self::$classPath.DIRECTORY_SEPARATOR.self::$methodPath;
        if(isset($calls[$cc]))
        {
            self::patternUrl($url,$reqUrl);
            kernel::initObserver(self::$controller);
            call_user_func_array(array(registerObj::$objs[self::$controller],self::$method),array($params));
        }
    }
}