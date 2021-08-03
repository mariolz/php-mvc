<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/31
 * Time: 16:43
 */

namespace Vendor\lib;
use IFS\Template\Template;
class templates implements Template
{
    private $tpl=[];
    private $vArr = [];
    private $controller;
    private $method;
    private $suffix;
    private $cacheFile;
    function __construct()
    {
        $this->controller=basename(str_replace("\\","/",$GLOBALS['controller']))??'index';
        $this->method=str_replace("Action","",$GLOBALS['method'])??'index';
        $this->suffix='.php';
    }

    function display($tpl,$compileDir='')
    {
        $this->tpl[$this->controller][$this->method] = TPLROOT.DIRECTORY_SEPARATOR.$this->controller.DIRECTORY_SEPARATOR.$this->method.DIRECTORY_SEPARATOR.$tpl.$this->suffix??"";
        $pattern = "#{{(.*?)}}#i";
        $content = file_get_contents($this->tpl[$this->controller][$this->method]);
        $res = $this->replacePattern($pattern,$content);
            $compileDir =COMPILEPATH.DIRECTORY_SEPARATOR.$this->controller.DIRECTORY_SEPARATOR.$this->method.DIRECTORY_SEPARATOR;
        $this->compile($res,$compileDir,$tpl);
        require $this->cacheFile;

    }
    function assign($k,$v)
    {
        $this->vArr[$k] = $v;
    }
    function compile($content,$complieDir,$tplname)
    {
        $this->cacheFile = $complieDir.$tplname.'.php';
        if(is_dir($complieDir))
        {
            return file_put_contents($this->cacheFile,$content);
        } else {
            mkdir($complieDir,0777,true);
            return file_put_contents($this->cacheFile,$content);
        }
    }

    function setPatternFlag($left,$right)
    {}
    function parseVar($pattern,$content)
    {

        //$content = str_replace("$","",$content);
        preg_match_all($pattern,$content,$matches);
        $replacements = [];
        //print_r($content1);die;
        foreach ($matches[1] as $k=>$v) {
            //$matches[0][$k] = str_replace("$","",$matches[0][$k]);
            //$v = str_replace("$","",$v);
            $matches[0][$k] = '/'.addcslashes($matches[0][$k],'(,$,)').'/';
            if(preg_match("#(foreach.*\((.*?)\))#i",$v))
            {
                $replacements [$k] = "<?php ".$v." {?>";
            } else if(preg_match("#(endforeach)#i",$v)){
                $replacements [$k] = "<?php  }?>";
            }else {
                $replacements [$k] = "<?php echo ".$v."?>";
            }


        }
        //print_r($this->vArr);die;
        $content = preg_replace($matches[0],$replacements,$content);
        $phpVar = '';
        foreach ($this->vArr as $k=>$v)
        {
            if(is_array($v))
            {
                $phpVar .= "<?php \$$k =".var_export($v,true)."; ?>";
            } else {
                $phpVar .= "<?php \$$k ='".$v."'; ?>";
            }
        }

        return $phpVar.$content;
    }
    function replacePattern($pattern,$content)
    {
        return $this->parseVar($pattern,$content);

    }
}