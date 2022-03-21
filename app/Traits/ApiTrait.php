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
namespace App\Traits;

use App\Constants\ErrorCode;
use App\Logs\Log;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use JsonException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use function config;

trait ApiTrait
{
    /**
     * @Inject
     */
    protected ContainerInterface $container;

    /**
     * @Inject
     */
    protected RequestInterface $request;

    /**
     * @Inject
     */
    protected ResponseInterface $response;

    /**
     * FunctionName：error
     * Description：
     * Author：zhangkang.
     * @throws JsonException
     */
    protected function error(int $statusCode = ErrorCode::SERVER_ERROR, string $message = null): PsrResponseInterface
    {
        $message ??= ErrorCode::SERVER_ERROR;

        return $this->response->json($this->formatResponse([], $message, $statusCode));
    }

    /**
     * FunctionName：formatResponse
     * Description：
     * Author：zhangkang.
     * @throws JsonException
     */
    protected function formatResponse(array $data = [], string $message = 'Success', int $statusCode = ErrorCode::SUCCESS): array
    {
        $return = [
            'code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ];

        if (config('response_log')) Log::responseLog()->info('返回参数：' . json_encode($return, JSON_THROW_ON_ERROR));

        return $return;
    }


    /**
     * FunctionName：buildSuccess
     * Description：成功返回
     * Author：zhangkang
     * @param array $data
     * @param string $message
     * @param int $code
     * @return array
     */
    public function buildSuccess(array $data = [], string $message = ErrorCode::MESSAGES[ErrorCode::SUCCESS], int $code = ErrorCode::SUCCESS): array
    {
        return [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];
    }

    /**
     * FunctionName：buildFailed
     * Description：失败返回
     * Author：zhangkang
     * @param $codeResponse
     * @param array|null $data
     * @return array
     */
    public function buildFailed($codeResponse, array $data = []): array
    {
        return [
            'code' => $codeResponse['code'],
            'message' => $codeResponse['message'],
            'data' => $data,
        ];
    }
}
