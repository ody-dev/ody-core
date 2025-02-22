<?php
declare(strict_types = 1);
include('bin/index.php');

$server = new \Ody\Core\Server\PhpServer();
$server->start($app);