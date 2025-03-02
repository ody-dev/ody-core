<?php
declare(strict_types=1);
namespace Ody\Core\Foundation\Http\Convert;

use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Component\HttpFoundation\Request;

class Psr7ToSymfonyRequest
{
    public function handle(ServerRequestInterface $request): Request
    {
        $httpFoundationFactory = new HttpFoundationFactory();

        return $httpFoundationFactory->createRequest($request);
    }
}