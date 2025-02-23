<?php
declare(strict_types = 1);

define('PROJECT_PATH' , realpath('./'));
require realpath('./vendor/autoload.php');

$app = \Ody\Core\Server\Http::initApp();
$server = new \Ody\Core\Server\PhpServer();
$server->start($app);