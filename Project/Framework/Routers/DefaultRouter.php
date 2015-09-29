<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/29/2015
 * Time: 6:00 AM
 */

namespace FW\Routers;


class DefaultRouter implements \FW\Routers\IRouter
{
    public function getURI(){
        return substr($_SERVER['PHP_SELF'], strlen($_SERVER['SCRIPT_NAME'])+1);
    }
}