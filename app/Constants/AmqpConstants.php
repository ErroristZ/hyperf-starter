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
namespace App\Constants;

class AmqpConstants
{
    /**
     * 处理接收阿里云MNS消息 - 事件名.
     */
    public const EVENT_ADD = 'event_order_add';

    public const getMap = [
        self::EVENT_ADD => '创建订单',
    ];
}
