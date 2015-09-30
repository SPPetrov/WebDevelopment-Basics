<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/27/2015
 * Time: 10:27 PM
 */

$cnf['default']['connection_uri'] = 'mysql:host=localhost;dbname=CartDB';
$cnf['default']['username'] = 'root';
$cnf['default']['password'] = '';
$cnf['default']['pdo_options'][PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'UTF8'";
$cnf['default']['pdo_options'][PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

return $cnf;