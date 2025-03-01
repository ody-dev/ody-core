<?php

namespace Ody\Core\Server;

use Composer\InstalledVersions;
use Ody\Core\Exceptions\PackageNotFoundException;

class Dependencies
{
    public static function check(\Ody\Core\Console\Style $io): bool
    {
        if (!InstalledVersions::isInstalled('ody/swoole')) {
            $io->error('Missing dependencies. Please run `composer require ody/swoole` to install the missing dependencies!.' , true);

            return false;
        }

        if (!extension_loaded('swoole')){
            $io->error("The php-swoole extension is not installed! Please run `apt install php8.3-swoole`." , true);

            return false;
        }

        return true;
    }
}