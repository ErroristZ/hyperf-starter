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
namespace App\Amqp\Consumer;

use App\Constants\AmqpConstants;
use App\Service\Repository\LockRedis;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Builder\QueueBuilder;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Result;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Coroutine;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Swoole\Server;

/**
 * @Consumer(exchange="order", routingKey="order", queue="order", nums=10)
 */
class OrderConsumer extends ConsumerMessage
{
    /**
     * 消息事件与回调事件绑定.
     * @var array
     */
    public const EVENTS = [
        AmqpConstants::EVENT_ADD => 'onOrderAdd',
    ];

    /**
     * @var mixed|Server
     */
    protected $server;

    /**
     * MnsConsumer constructor.
     */
    public function __construct()
    {
        $this->server = ApplicationContext::getContainer()->get(Server::class);

        // 动态设置 Rabbit MQ 消费队列名称
        $this->setQueue('queue:order:' . SERVER_RUN_ID);
    }

    /**
     * 重写创建队列生成类
     * 注释：设置自动删除队列.
     */
    public function getQueueBuilder(): QueueBuilder
    {
        return parent::getQueueBuilder()->setAutoDelete(true);
    }

    /**
     * 消费队列消息.
     * @param mixed $data
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function consumeMessage($data, AMQPMessage $message): string
    {
        if (isset($data['event'])) {
            // [加锁]防止消息重复消费
            $lockName = sprintf('wss-message:%s-%s', SERVER_RUN_ID, $data['uuid']);
            if (! LockRedis::getInstance()->lock($lockName, 60)) {
                return Result::ACK;
            }

            # #创建协程处理业务处理
            Coroutine::create(function () use ($data) {
                // 调用对应事件绑定的回调方法
                return $this->{self::EVENTS[$data['event']]}($data);
            });
        }
        return Result::ACK;
    }

    /**
     * FunctionName：onOrderAdd
     * Description：
     * Author：zhangkang.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function onOrderAdd(array $data): string
    {
        // [加锁]防止消息重复消费
        $lockName = sprintf('wss-message:%s-%s', SERVER_RUN_ID, $data['data']['ordersn']);
        if (! LockRedis::getInstance()->lock($lockName, 10)) {
            return Result::ACK;
        }

        echo 1;
        return Result::ACK;
    }

    public function isEnable(): bool
    {
        return true;
    }
}
