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
namespace App\Service\Redis;

use Hyperf\Redis\Redis;
use Hyperf\Utils\ApplicationContext;

class RedisClientService
{
    /**
     * fd与用户绑定(使用hash 做处理).
     */
    public const BIND_FD_TO_USER = 'iot:list';

    /**
     * @var Redis
     */
    private $redis;

    public function __construct()
    {
        $container = ApplicationContext::getContainer();

        $this->redis = $container->get(Redis::class);
    }

    /**
     * 连接数据与设备ID绑定关系.
     * @param string $data 连接数据
     * @param string $station_id 设备ID
     */
    public function binding(string $data, string $station_id): void
    {
        $this->redis->multi();
        $this->redis->set(sprintf('%s:%s', self::BIND_FD_TO_USER, $station_id), $data);
        $this->redis->expire(sprintf('%s:%s', self::BIND_FD_TO_USER, $station_id), 604800); // 缓存七天
        $this->redis->exec();
    }

    /**
     * 查询客户端fd对应的用户ID.
     * @param string $user_id 客户端ID
     */
    public function findFdUserId(string $user_id): int
    {
        return $this->redis->get(sprintf('%s:%s', self::BIND_FD_TO_USER, $user_id)) ?: 0;
    }

    /**
     * 检测设备Id.
     * @param string $station_id 用户ID
     */
    public function isOnline(string $station_id): bool
    {
        return (bool) $this->redis->get(sprintf('%s:%s', self::BIND_FD_TO_USER, (string) $station_id));
    }

    /**
     * 连接数据与设备ID绑定关系.
     * @param string $data 连接数据
     * @param string $topic 设备ID
     * @param string $id 消息ID
     */
    public function MnsReceive(string $data, string $topic, string $id): void
    {
        $this->redis->multi();
        $this->redis->set(sprintf('%s:%s:%s', self::BIND_FD_TO_USER, $topic, $id), $data);
        $this->redis->expire(sprintf('%s:%s:%s', self::BIND_FD_TO_USER, $topic, $id), 604800); // 缓存
        $this->redis->exec();
    }
}
