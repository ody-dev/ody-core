<?php
declare(strict_types = 1);

use Ody\Core\App;
use Ody\Core\Server\PhpServer;

define('PROJECT_PATH' , realpath('./'));
/** @psalm-suppress UnresolvableInclude */
require realpath('./vendor/autoload.php');

PhpServer::init(
    App::init()
);
