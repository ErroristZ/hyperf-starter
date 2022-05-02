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

class RedisClientService
{
    /**
     * fd与用户绑定(使用hash 做处理).
     */
    public const BIND_FD_TO_USER = 'routers:list';

    /**
     * @Message("在线用户与Fd绑定关系")
     */
    public const ONLINE_USER_FD_KEY = 'online_user_fd_list';

    /**
     * @Message("Fd与在线用户绑定关系")
     */
    public const ONLINE_FD_USER_KEY = 'online_fd_user_list';

    /**
     * @Message("用户未读的聊天记录")
     */
    public const GROUP_CHAT_UNREAD_MESSAGE_BY_USER = 'group_chat_unread_message_user_';

    /**
     * @var Redis
     */
    private $redis;

    public function __construct()
    {
        $this->redis = di()->get(Redis::class);
    }

    /**
     * 连接数据与设备ID绑定关系.
     * @param string $data 连接数据
     * @param int $station_id 设备ID
     */
    public function binding(string $data, int $station_id): void
    {
        $this->redis->multi();
        $this->redis->set(sprintf('%s:%s', self::BIND_FD_TO_USER, $station_id), $data);
        $this->redis->expire(sprintf('%s:%s', self::BIND_FD_TO_USER, $station_id), 604800); // 缓存七天
        $this->redis->exec();
    }

    /**
     * 查询客户端fd对应的用户ID.
     * @param int $user_id 客户端ID
     */
    public function findFdUserId(int $user_id)
    {
        return $this->redis->get(sprintf('%s:%s', self::BIND_FD_TO_USER, $user_id));
    }

    /**
     * 检测设备Id.
     * @param int $station_id 用户ID
     */
    public function isOnline(int $station_id): bool
    {
        return (bool) $this->redis->get(sprintf('%s:%s', self::BIND_FD_TO_USER, $station_id));
    }

    /**
     * FunctionName：delete
     * Description：
     * Author：zhangkang.
     */
    public function delete(): void
    {
        $this->redis->del(self::BIND_FD_TO_USER);
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

    /**
     * FunctionName：findUserId
     * Description：
     * Author：zhangkang.
     */
    public function findUserId(string $fd): bool|\Redis|string
    {
        return $this->redis->hGet(self::ONLINE_USER_FD_KEY, $fd);
    }

    /**
     * @param $id
     * @param $fd
     */
    public function delUserId($id, $fd): void
    {
        $this->redis->hDel(self::ONLINE_USER_FD_KEY, (string) $id);
        $this->redis->hDel(self::ONLINE_FD_USER_KEY, (string) $fd);
    }

    /**
     * FunctionName：savaUserID
     * Description：
     * Author：zhangkang.
     */
    public function savaUserID(mixed $id, mixed $fd): void
    {
        // 将在线用户放置Redis中
        $this->redis->hSet(self::ONLINE_USER_FD_KEY, (string) $id, (string) $fd);
        // 将FD对应在线用户ID放置Redis中
        $this->redis->hSet(self::ONLINE_FD_USER_KEY, (string) $fd, (string) $id);
    }
}
