<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Exception\Handler;

use App\Exception\BusinessException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use InvalidArgumentException;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class BusinessExceptionHandle extends ExceptionHandler
{
    /**
     * @throws JsonException
     */
    public function handle(Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $data = json_encode([
            'code' => $throwable->getCode(),
            'message' => $throwable->getMessage(),
        ], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
        $this->stopPropagation();
        return $response->withHeader('Server', 'Hyperf')
            ->withAddedHeader('content-type', 'application/json; charset=utf-8')
            ->withStatus($throwable->getCode())->withBody(new SwooleStream($data));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof BusinessException || $throwable instanceof InvalidArgumentException;
    }
}
