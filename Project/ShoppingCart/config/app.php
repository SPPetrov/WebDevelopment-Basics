<?php

$cnf['dafault_controller'] = 'Index';
$cnf['dafault_method'] = 'index';

$cnf['namespaces']['Controllers'] = '../Controllers/';

$cnf['session']['autostart'] = true;
$cnf['session']['type'] = 'native';
$cnf['session']['name'] = 'app_session';
$cnf['session']['lifetime'] = 3600;
$cnf['session']['path'] = '/';
$cnf['session']['domain'] = '';
$cnf['session']['secure'] = false;
return $cnf;