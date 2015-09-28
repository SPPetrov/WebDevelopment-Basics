<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/28/2015
 * Time: 12:38 AM
 */

namespace FW;


class FrontController
{
    private static $_instance = null;

    public function __construct(){

    }

    public function dispatch(){

    }
    /**
     * @return \FW\Frontcontroller
     */
    public static function getInstance()
    {
        if(self::$_instance == null){
            self::$_instance = new \FW\FrontController();
        }
        return self::$_instance;
    }




}