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
namespace App\Service\Amqp;

use Hyperf\Amqp\Builder\Builder;
use Hyperf\Amqp\Builder\QueueBuilder;
use PhpAmqpLib\Wire\AMQPTable;

class AmqpBuilder extends QueueBuilder
{
    /**
     * @param AMQPTable|array $arguments
     */
    public function setArguments($arguments): Builder
    {
        $this->arguments = array_merge($this->arguments, $arguments);
        return $this;
    }

    /**
     * 设置延时队列相关参数.
     * @return $this
     */
    public function setDelayedQueue(string $queueName, int $xMessageTtl, string $xDeadLetterExchange, string $xDeadLetterRoutingKey): self
    {
        $this->setArguments([
            'x-message-ttl' => ['I', $xMessageTtl * 1000], // 毫秒
            'x-dead-letter-exchange' => ['S', $xDeadLetterExchange],
            'x-dead-letter-routing-key' => ['S', $xDeadLetterRoutingKey],
        ]);
        $this->setQueue($queueName);
        return $this;
    }
}
