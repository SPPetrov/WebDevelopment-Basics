<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/29/2015
 * Time: 7:54 PM
 */

namespace FW;


class InputData
{
    private static $_instance = null;
    private $_get = array();
    private $_post = array();
    private $_cookies = array();
}