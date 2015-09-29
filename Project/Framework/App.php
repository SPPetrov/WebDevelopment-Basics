<?php

namespace FW;
include_once 'Loader.php';

class App{
    private static $_instance = null;
    private $_config = null;
    private $router = null;
    /**
     * @var \FW\FrontController
     */
    private $_frontController = null;

    private function __construct()
    {
        \FW\Loader::registerNamespace('FW', dirname(__FILE__).DIRECTORY_SEPARATOR);
        \FW\Loader::registerAutoLoad();
        $this->_config = \FW\Config::getInstance();

        if($this->_config->getConfigFolder() == null){
            $this->setConfigFolder('../config');
        }
    }

    public function setConfigFolder($path)
    {
        $this->_config->setConfigFolder($path);
    }

    public function getConfigFolder()
    {
        return $this->_configFolder;
    }


    public function getRouter()
    {
        return $this->router;
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }

    /**
     * @return \FW\Config
     */
    public function getConfig(){
        return $this->_config;
    }

    public function run(){
        if($this->_config->getConfigFolder() == null){
            $this->setConfigFolder('../config');
        }
        $this->_frontController = \FW\FrontController::getInstance();
        $this->_frontController->setRouter(new \FW\Routers\DefaultRouter());
        $this->_frontController->dispatch();
    }

    /**
     * @return \FW\App
     */
    public static function getInstance()
    {
        if(self::$_instance == null){
            self::$_instance = new \FW\App();
        }

        return self::$_instance;
    }


}