<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/27/2015
 * Time: 6:57 PM
 */

namespace FW;


class Config
{
    private static $_instance = null;
    private $_configFolder = null;
    private $_configArray = array();

    private function  __construct(){

    }

    public function getConfigFolder(){
        return $this->_configFolder;
    }

    public function setConfigFolder($configFolder){
        if(!$configFolder){
            throw new \Exception('Empty config folder path:');
        }
        $realFolder = realpath($configFolder);
        if($realFolder != FALSE && is_dir($realFolder) && is_readable($realFolder)){
            $this->_configArray = array();
            $this->_configFolder = $realFolder . DIRECTORY_SEPARATOR;

            $ns=$this->app['namespaces'];
            if(is_array($ns)){
                \FW\Loader::registerNamespaces($ns);
            }

        }else{
            throw new \Exception('Config directory read error:' . $configFolder);
        }
    }

    public function includeConfigFile($path){
        if(!$path){
            throw new \Exception('Empty config path');
        }
        $_file = realpath($path);
        if($_file != FALSE && is_file($_file) && is_readable($_file)){
            $_basename = explode('.php', basename($_file))[0];
            $this->_configArray[$_basename]= include $_file;

        }else{
            throw new \Exception('Config file read error:' . $path);
        }
    }

    public function __get($name){
        if(!$this->_configArray[$name]){
            $this->includeConfigFile($this->_configFolder . $name . '.php');
        }
        if(array_key_exists($name, $this->_configArray)){
            return $this->_configArray[$name];
        }
        return null;
    }


    /**
     * @return \FW\Config
     */
    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new \FW\Config();
        }
        return self::$_instance;
    }


}