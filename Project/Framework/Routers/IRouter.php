<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/29/2015
 * Time: 11:17 AM
 */

namespace FW\Routers;


interface IRouter
{
    public function getURI();
    public function getPost();
}