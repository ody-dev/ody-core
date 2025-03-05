<?php
declare(strict_types=1);

namespace Ody\Core\Foundation;

use App\Http\HttpKernel;

class Bootstrap
{
    public static function init(App $app)
    {
        if ($app->runningInConsole()) {
            return ConsoleKernel::bootstrap($app)
                ->getApplication();
        }

        $app->bind('runningInConsole', false);
        return HttpKernel::bootstrap($app)
            ->getApplication();
    }
}