<?php
$cnf['admin']['namespace']='Controllers\Admin';
$cnf['admin']['controllers']['index']['to']='index';

$cnf['editor']['namespace']='Controllers\Editor';
$cnf['administration']['namespace']='Controllers\Admin';

$cnf['editor']['controllers']['index']['to']='IndexController';

$cnf['administration']['controllers']['index']['to']='index'; // smqna na kontrolera
$cnf['administration']['controllers']['index']['methods']['new']='_new';  // prezapisvane na metodi
$cnf['administration']['controllers']['new']['to']='create';
$cnf['*']['namespace'] = 'Controllers';

return $cnf;