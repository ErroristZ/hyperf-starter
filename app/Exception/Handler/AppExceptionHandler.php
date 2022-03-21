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
use App\Traits\ApiTrait;
use Hyperf\Di\Annotation\Inject;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpServer\Contract\RequestInterface;
use Phper666\JWTAuth\Exception\JWTException;
use Phper666\JWTAuth\Exception\TokenValidException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    use ApiTrait;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @Inject
     * @var \Hyperf\HttpServer\Contract\ResponseInterface
     */
    protected \Hyperf\HttpServer\Contract\ResponseInterface $response;

    public function handle(Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $message = '服务器错误 ' . $throwable->getMessage() . ':: FILE:' . $throwable->getFile() . ':: LINE: ' . $throwable->getLine();

        if ($throwable instanceof TokenValidException) {
            $this->stopPropagation();
            return $this->error($throwable->getCode(), $throwable->getMessage());
        }

        if ($throwable instanceof JWTException) {
            $this->stopPropagation();
            return $this->error($throwable->getCode(), $throwable->getMessage());
        }

        if ($throwable instanceof BusinessException) {
            $this->stopPropagation();
            return $this->error($throwable->getCode(), $throwable->getMessage());
        }
        return $this->error(500, $message);

    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
