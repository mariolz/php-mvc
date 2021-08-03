<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/2/1
 * Time: 0:54
 */
namespace IFS\Template;
interface Template {
    function display($tpl,$params);
    function assign($k,$v);
    function compile($content,$complieDir,$tplname);
    function setPatternFlag($left,$right);
    function replacePattern($pattern,$content);
}