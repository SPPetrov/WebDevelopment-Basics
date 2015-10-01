<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/30/2015
 * Time: 10:59 PM
 */

namespace FW;


class DefaultController
{
    /**
     * @var \FW\App
     */
    public $app;
    /**
     * @var \FW\View
     */
    public $view;
    /**
     * @var \FW\Config
     */
    public $config;
    /**
     * @var \FW\InputData
     */
    public $input;

    public function __construct()
    {
        $this->app = \FW\App::getInstance();
        $this->view = \FW\View::getInstance();
        $this->config = $this->app->getConfig();
        $this->input = \FW\InputData::getInstance();
    }
}