<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/29/2015
 * Time: 6:00 AM
 */

namespace FW\Routers;


class DefaultRouter
{
    private $controller = null;
    private $method = null;
    private $params = array();

    public function parse(){
        $_uri = substr($_SERVER['PHP_SELF'], strlen($_SERVER['SCRIPT_NAME'])+1);


        $_params = explode('/', $_uri);
        if($_params[0]) {
            $this->controller = ucfirst($_params[0]);

            if ($_params[1]) {
                $this->method = $_params[1];
                unset($_params[0], $_params[1]);
                $this->params = array_values($_params);
            }
        }
    }

    public function getController(){
        return $this->controller;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getGet(){
        return $this->params;
    }


}