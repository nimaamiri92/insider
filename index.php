<?php

define('ROOT' , __DIR__);
define('DS' , DIRECTORY_SEPARATOR);
require  './vendor/autoload.php';


$application = \App\Application::getInstance();
$application->run();

