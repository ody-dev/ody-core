<?php
namespace Ody\Core\Foundation\Http;

use Laminas\Diactoros\ServerRequest;
use Ody\Core\Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoole\Http\Request;
use Swoole\Http\Response;
use function Laminas\Diactoros\normalizeUploadedFiles;

final class RequestCallback
{
    private RequestHandlerInterface $handler;
    private RequestCallbackOptions $options;

    public function __construct(RequestHandlerInterface $handler, ?RequestCallbackOptions $options = null)
    {
        $this->handler = $handler;
        $this->options = $options ?? new RequestCallbackOptions();
    }

    public function handle(Request $request, Response $response): void
    {
        $this->emit($this->handler->handle($this->createServerRequest($request)), $response);
    }

    private function createServerRequest(Request $swooleRequest): ServerRequestInterface
    {
        Logger::write('info',
            "{$swooleRequest->getMethod()} - {$swooleRequest->server['remote_addr']}:{$swooleRequest->server['server_port']}{$swooleRequest->server['request_uri']}"
        );

        /** @var array<string, string> $server */
        $server = $swooleRequest->server;

        /** @var array<array> | array<empty> $files */
        $files = $swooleRequest->files ?? [];

        /** @var array<string, string> | array<empty> $headers */
        $headers = $swooleRequest->header ?? [];

        /** @var array<string, string> | array<empty> $cookies */
        $cookies = $swooleRequest->cookie ?? [];

        /** @var array<string, string> | array<empty> $query_params */
        $query_params = $swooleRequest->get ?? [];

        return new ServerRequest(
            $server,
            normalizeUploadedFiles($files),
            $server['request_uri'] ?? '/',
            $server['request_method'] ?? 'GET',
            $this->options->getStreamFactory()->createStream($swooleRequest->rawContent()),
            $headers,
            $cookies,
            $query_params,
        );
    }

    private function emit(ResponseInterface $psrResponse, Response $swooleResponse): void
    {
        $swooleResponse->setStatusCode($psrResponse->getStatusCode(), $psrResponse->getReasonPhrase());

        foreach ($psrResponse->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                $swooleResponse->setHeader($name, $value);
            }
        }

        $body = $psrResponse->getBody();
        $body->rewind();

        if ($body->isReadable()) {
            if ($body->getSize() <= $this->options->getResponseChunkSize()) {
                if ($contents = $body->getContents()) {
                    $swooleResponse->write($contents);
                }
            } else {
                while (!$body->eof() && ($contents = $body->read($this->options->getResponseChunkSize()))) {
                    $swooleResponse->write($contents);
                }
            }

            $swooleResponse->end();
        } else {
            $swooleResponse->end((string) $body);
        }

        $body->close();
    }
}