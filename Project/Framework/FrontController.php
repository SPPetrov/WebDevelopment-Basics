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
    const DEFAULT_CONTROLLER = 'Index';
    const DEFAULT_METHOD = 'index';

    private static $_instance = null;

    public function __construct(){

    }

    public function dispatch(){
        $a = new \FW\Routers\DefaultRouter();
        $a->getURI();
    }

    public function getDefaultController(){
        $controller = \FW\App::getInstance()->getConfig()->app['dafault_controller'];
        if($controller){
            return $controller;
        }
        return self::DEFAULT_CONTROLLER;
    }

    public function getDefaultMethod(){
        $method = \FW\App::getInstance()->getConfig()->app['dafault_method'];
        if($method){
            return $method;
        }
        return self::DEFAULT_METHOD;
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