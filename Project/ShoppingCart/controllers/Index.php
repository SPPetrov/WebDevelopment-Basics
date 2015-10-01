<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/29/2015
 * Time: 11:31 AM
 */

namespace Controllers;


use FW\DefaultController;

class Index extends  DefaultController
{
    public function index2(){

        $view = \FW\View::getInstance();
        $view->username = 'Baj Ivan';
        $view->appendToLayout('body','admin.index');
        $view->display('layouts.default', array('c'=>array(1,2,3,5,8)));

    }
}