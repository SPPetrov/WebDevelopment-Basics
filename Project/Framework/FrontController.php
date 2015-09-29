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
    private $ns = null;
    private $controller = null;
    private $method = null;

    public function __construct(){

    }

    public function dispatch(){
        $a = new \FW\Routers\DefaultRouter();
        $_uri = $a->getURI();
        $routes = \FW\App::getInstance()->getConfig()->routes;
        $_rc=null;
        if(is_array($routes) && count($routes) > 0){
            foreach ($routes as $k => $v ) {
                if(stripos($_uri, $k)===0 &&
                    ($_uri==$k || stripos($_uri, $k.'/')===0)
                    && $v['namespace']){
                    $this->ns = $v['namespace'];
                    $_uri=substr($_uri, strlen($k)+1);
                    $_rc=$v;
                    break;
                }
            }
        }else{
            throw new \Exception('Default route mising', 500);
        }

        if($this->ns == null && $routes['*']['namespace']){
            $this->ns = $routes['*']['namespace'];
            $_rc=$routes['*'];
        }elseif($this->ns == null && !$routes['*']['namespace']){
            throw new \Exception('Default route missing', 500);
        }

        $_params = explode('/', $_uri);
        if($_params[0]){
            $this->controller=$_params[0];

            if($_params[1]){
                $this->method=$_params[1];
            }else{
                $this->method=$this->getDefaultMethod();
            }
        }else{
            $this->controller=$this->getDefaultController();
            $this->method=$this->getDefaultMethod();
        }

        if(is_array($_rc) && $_rc['controllers'] && $_rc['controllers'][$this->controller]){
            $this->controller = $_rc['controllers'][$this->controller];
        }
        echo $this->controller;
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