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

use Hyperf\Amqp\Annotation\Producer;
use Hyperf\Amqp\Builder;
use Hyperf\Amqp\Message\ProducerMessageInterface;
use Hyperf\Di\Annotation\AnnotationCollector;
use PhpAmqpLib\Message\AMQPMessage;
use Throwable;

class DelayProducer extends Builder
{
    /**
     * @throws \Throwable
     */
    public function produce(ProducerMessageInterface $producerMessage, AmqpBuilder $queueBuilder, bool $confirm = false, int $timeout = 5): bool
    {
        return retry(1, function () use ($producerMessage, $queueBuilder, $confirm, $timeout) {
            return $this->produceMessage($producerMessage, $queueBuilder, $confirm, $timeout);
        });
    }

    /**
     * @throws \Throwable
     */
    private function produceMessage(ProducerMessageInterface $producerMessage, AmqpBuilder $queueBuilder, bool $confirm = false, int $timeout = 5): bool
    {
        $result = false;

        $this->injectMessageProperty($producerMessage);

        $message = new AMQPMessage($producerMessage->payload(), $producerMessage->getProperties());
        $connection = $this->factory->getConnection($producerMessage->getPoolName());
        if ($confirm) {
            $channel = $connection->getConfirmChannel();
        } else {
            $channel = $connection->getChannel();
        }
        $channel->set_ack_handler(function () use (&$result) {
            $result = true;
        });

        try {
            // 处理延时队列
            $exchangeBuilder = $producerMessage->getExchangeBuilder();

            // 队列定义
            $channel->queue_declare($queueBuilder->getQueue(), $queueBuilder->isPassive(), $queueBuilder->isDurable(), $queueBuilder->isExclusive(), $queueBuilder->isAutoDelete(), $queueBuilder->isNowait(), $queueBuilder->getArguments(), $queueBuilder->getTicket());

            // 路由定义
            $channel->exchange_declare($exchangeBuilder->getExchange(), $exchangeBuilder->getType(), $exchangeBuilder->isPassive(), $exchangeBuilder->isDurable(), $exchangeBuilder->isAutoDelete(), $exchangeBuilder->isInternal(), $exchangeBuilder->isNowait(), $exchangeBuilder->getArguments(), $exchangeBuilder->getTicket());

            // 队列绑定
            $channel->queue_bind($queueBuilder->getQueue(), $producerMessage->getExchange(), $producerMessage->getRoutingKey());

            // 消息发送
            $channel->basic_publish($message, $producerMessage->getExchange(), $producerMessage->getRoutingKey());
            $channel->wait_for_pending_acks_returns($timeout);
        } catch (Throwable $exception) {
            // Reconnect the connection before release.
            $connection->reconnect();
            throw $exception;
        } finally {
            $connection->release();
        }

        return $confirm ? $result : true;
    }

    private function injectMessageProperty(ProducerMessageInterface $producerMessage): void
    {
        if (class_exists(AnnotationCollector::class)) {
            /** @var Producer $annotation */
            $annotation = AnnotationCollector::getClassAnnotation(get_class($producerMessage), Producer::class);
            if ($annotation) {
                $annotation->routingKey && $producerMessage->setRoutingKey($annotation->routingKey);
                $annotation->exchange && $producerMessage->setExchange($annotation->exchange);
            }
        }
    }
}
