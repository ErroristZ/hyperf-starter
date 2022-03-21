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
namespace App\Amqp\Producer;

use Exception;
use Hyperf\Amqp\Annotation\Producer;
use Hyperf\Amqp\Message\ProducerMessage;

/**
 * DemoProducer.
 * @Producer(exchange="order", routingKey="order")
 */
class OrderProducer extends ProducerMessage
{
    /**
     * 实例化处理.
     * @param string $event 事件名
     * @param array $data 数据
     * @throws Exception
     */
    public function __construct(string $event, array $data)
    {
        $message = [
            'uuid' => uniqid((strval(random_int(0, 1000))), true),
            'event' => $event,
            'data' => $data,
        ];

        $this->payload = $message;
    }
}
