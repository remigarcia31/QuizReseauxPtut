<?php

spl_autoload_extensions(".php");
spl_autoload_register();

use yasmf\DataSource;
use yasmf\Router;

// changer la base de donnée quand le site sera sur alwaysdata

 $dataSource = new DataSource(
 $host = 'mysql-ptutquizz.alwaysdata.net',
 $port = '3306',
 $db = 'ptutquizz_bd',
 $user = 'ptutquizz',
 $pass = 'ptut123',
 $charset = 'utf8mb4'
 );


$router = new Router() ;
$router->route($dataSource);
