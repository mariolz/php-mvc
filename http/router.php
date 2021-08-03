<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 2021/1/26
 * Time: 18:25
 */
use Vendor\router;
router::route('/test1/myttt/{Ints,Bools,Bools}','http\controllers\Test@mytest');
router::route('/test2/myttt/{Ints,Bools,Bools}','http\controllers\Test@mytest3');