<?php
$cnf['admin']['namespace']='Controllers\Admin1';

$cnf['administration']['namespace']='Controllers\Admin';
$cnf['administration']['controllers']['index']['to']='test'; // smqna na kontrolera
$cnf['administration']['controllers']['index']['methods']['new']='_new';  // prezapisvane na metodi
$cnf['administration']['controllers']['new']['to']='create';
$cnf['*']['namespace'] = 'Controllers';

return $cnf;