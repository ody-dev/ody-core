<?php
declare(strict_types = 1);

use Ody\Core\Kernel;
use Ody\Core\Server\PhpServer;

define('PROJECT_PATH' , realpath('./'));
/** @psalm-suppress UnresolvableInclude */
require realpath('./vendor/autoload.php');

PhpServer::init(
    Kernel::init()
);
