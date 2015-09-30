<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/30/2015
 * Time: 2:09 AM
 */

namespace FW\Sessions;


interface ISession
{
    public function getSessionId();
    public function saveSession();
    public function destroySession();
    public function __get($name);
    public function __set($name, $value);
}