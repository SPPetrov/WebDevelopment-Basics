<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/30/2015
 * Time: 12:59 PM
 */

namespace FW;


class View
{
    private static $_instance = null;
    private $viewPath = null;
    private $viewDir = null;
    private $data = array();
    private $extension = '.php';
    private $layoutPart = array();
    private $layoutData = array();

    public function __construct()
    {
        $this->viewPath = \FW\App::getInstance()->getConfig()->app['viewsDirectory'];
        if($this->viewPath==null){
            $this->viewPath = realpath('../views/');
        }
    }

    public function setViewDirectory($path){
        $path = trim($path);
        if($path){
            $path = realpath($path).DIRECTORY_SEPARATOR;
            if(is_dir($path) && is_readable($path)){
                $this->viewDir = $path;
            }else{
                throw new \Exception('view path', 500);
            }
        }else{
            throw new \Exception('view path', 500);
        }
    }

    public function display($name, $data = array(), $returnAsString = false){
        if(is_array($data)){
            $this->data = array_merge($this->data, $data);
        }

        if(count($this->layoutPart)>0){
            foreach ($this->layoutPart as $k => $v ) {
                $r = $this->_includeFile($v);
                if($r){
                    $this->layoutData[$k] = $r;
                }
            }

        }

        if($returnAsString){
            return $this->_includeFile($name);
        }else{
            echo $this->_includeFile($name);
        }
    }

    public function getLayoutData($name){
        return $this->layoutData[$name];
    }

    public function appendToLayout($key, $template){
        if($key && $template){
            $this->layoutPart[$key] = $template;
        }else{
            throw new \Exception('Layout required valid key and template', 500);
        }
    }

    private function _includeFile($file){
        if($this->viewDir == null){
            $this->setViewDirectory($this->viewPath);
        }
        $p = str_replace('.', DIRECTORY_SEPARATOR, $file);
        $fl=$this->viewDir . $p . $this->extension;
        if(file_exists($fl) && is_readable($fl)){
            // adds to different buffer
            ob_start();
            include $fl;
            // returns the buffer as string
            return ob_get_clean();
        }else{
            throw new \Exception('View' . $file . 'cannot be included', 500);
        }
    }



    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @return \FW\View
     */
    public static function getInstance(){
        if(self::$_instance == null){
            self::$_instance = new \FW\View();
        }
        return self::$_instance;
    }
}