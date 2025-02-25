<?php
declare(strict_types=1);

namespace Ody\Core\Tests\Mocks;

use InvalidArgumentException;

use function compact;
use function count;
use function json_encode;

class MockAction
{
    public function __call($name, array $arguments)
    {
        if (count($arguments) !== 3) {
            throw new InvalidArgumentException("Not a Slim call");
        }

        $response = $arguments[1];
        $contents = json_encode(compact('name') + ['arguments' => $arguments[2]]);
        $arguments[1]->getBody()->write($contents);

        return $response;
    }
}
