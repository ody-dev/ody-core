<?php
include('bin/index.php');

$server = new \Ody\Core\Server\PhpServer();
$server->start($app);