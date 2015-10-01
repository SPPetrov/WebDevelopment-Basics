<?php

namespace FW;
include_once 'Loader.php';

class App{
    private static $_instance = null;
    private $_config = null;
    private $router = null;
    private $_dbConnections=array();
    private $_session = null;

    /**
     * @var \FW\FrontController
     */
    private $_frontController = null;

    private function __construct()
    {
        set_exception_handler(array($this, '_exceptionHandler'));
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

        $_sess = $this->_config->app['session'];

        if($_sess['autostart']){
            if($_sess['type']=='native'){
                $_s = new \FW\Sessions\NativeSession($_sess['name'],
                    $_sess['lifetime'], $_sess['path'], $_sess['domain'], $_sess['secure']);
            }else{
                throw new \Exception('No valid session', 500);
            }
            $this->setSession($_s);
        }
        $this->_frontController->dispatch();
    }

    public function setSession(\FW\Sessions\ISession $session){
        $this->_session = $session;
    }

    /**
     * @return \FW\Sessions\ISession
     */
    public function getSession()
    {
        return $this->_session;
    }



    public function getDBConnection($connection='default'){
        if(!$connection){
            throw new \Exception('No connection identifier providet', 500);
        }
        if($this->_dbConnections[$connection]){
            return $this->_dbConnections[$connection];
        }
        $_cnf = $this->getConfig()->database;

        if(!$_cnf[$connection]){
            throw new \Exception ('No valid connection identificator is proded', 500);
        }

        $dbh=new \PDO($_cnf[$connection]['connection_uri'], $_cnf[$connection]['username'],
            $_cnf[$connection]['password'], $_cnf[$connection]['pdo_options']);
        $this->_dbConnections[$connection]=$dbh;
        return $dbh;
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

    public function _exceptionHandler(\Exception $ex) {
        if ($this->_config && $this->_config->app['displayExceptions'] == true) {
            echo '<pre>' . print_r($ex, true) . '</pre>';
        } else {
            $this->displayError($ex->getCode());
        }
    }

    public function displayError($error) {
        try {
            $view = \FW\View::getInstance();
            $view->display('errors.' . $error);
        } catch (\Exception $exc) {
            \FW\Common::headerStatus($error);
            echo '<h1>' . $error . '</h1>';
            exit;
        }
    }

    public function __destruct()
    {
        if ($this->_session != null) {
            $this->_session->saveSession();
        }
    }
}