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
namespace App\Service\Repository;

use Hyperf\Redis\Redis;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

abstract class AbstractRedis
{
    protected $prefix = 'rds';

    protected $name = '';

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getInstance()
    {
        return di()->get(static::class);
    }

    /**
     * 获取 Redis 连接.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @return mixed|Redis
     */
    protected function redis()
    {
        return di()->get(Redis::class);
    }

    /**
     * 获取缓存 KEY.
     */
    protected function getCacheKey(array|string $key = ''): string
    {
        $params = [$this->prefix, $this->name];
        if (is_array($key)) {
            $params = array_merge($params, $key);
        } else {
            $params[] = $key;
        }

        return $this->filter($params);
    }

    protected function filter(array $params = []): string
    {
        foreach ($params as $k => $param) {
            $params[$k] = trim($param, ':');
        }

        return implode(':', array_filter($params));
    }
}
