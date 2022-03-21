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
namespace App\Logs;

use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;

class Log
{
    /**
     * 日志通道.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function channel(string $name = 'log', string $group = 'default'): LoggerInterface
    {
        return ApplicationContext::getContainer()->get(LoggerFactory::class)->get($name, $group);
    }

    /**
     * 接口返回日志.
     */
    public static function responseLog(): LoggerInterface
    {
        return self::channel('log', 'response_log');
    }
}
