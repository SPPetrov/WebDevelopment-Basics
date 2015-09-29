<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/27/2015
 * Time: 11:49 AM
 */

namespace FW;


final class Loader
{

    private  static $namespaces = array();

    private function __construct(){

    }

    public static function registerAutoLoad(){
        spl_autoload_register(array("\FW\Loader", 'autoload'));
    }

    public static function autoload($class){
        self::loadClass($class);
    }

    public static function loadClass($class){
        foreach (self::$namespaces as $namespace => $path ) {
            if(strpos($class, $namespace) === 0){

                $systemPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);
                $filePath = substr_replace($systemPath, $path, 0, strlen($namespace)).'.php';
                $realFilePath = realpath($filePath);

                if($realFilePath && is_readable($realFilePath)){
                    include $realFilePath;
                }else{
                    throw new \Exception('File cannot be included:' . $realFilePath);
                }
                break;
            }
        }

    }


    public static function registerNamespace($namespace, $path){
        $namespace = trim($namespace);
        if(strlen($namespace) > 0){
            if(!$path){
                throw new \Exception('Invalid path');
            }
            $_path = realpath($path);

            if($_path && is_dir($_path) && is_readable($_path) ){
                self::$namespaces[$namespace.'\\'] = $_path . DIRECTORY_SEPARATOR;
            }else{
                throw new \Exception('Namespace directory read error:' . $path);
            }

        }else{
            throw new \Exception('Invalid namespace');
        }
    }

    public static function registerNamespaces($namespaces){
        if(is_array($namespaces)){
            foreach ($namespaces as $namespace => $path  ) {

                self::registerNamespace($namespace, $path);
            }

        }else{
            throw new \Exception('Invalid namespaces');
        }
    }
}