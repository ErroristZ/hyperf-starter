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
namespace App\Listener;

use App\Event\LogsAdd;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Kafka\Producer;
use Psr\Container\ContainerInterface;

/**
 * @AutoController
 * @Listener
 */
class LogsAddListener implements ListenerInterface
{
    private ContainerInterface $container;

    private Producer $kafkaProducer;

    public function __construct(ContainerInterface $container, Producer $kafkaProducer)
    {
        $this->container = $container;
        $this->kafkaProducer = $kafkaProducer;
    }

    /**
     * FunctionName：listen
     * Description：
     * Author：zhangkang.
     * @return string[]
     */
    public function listen(): array
    {
        return [
            LogsAdd::class,
        ];
    }

    /**
     * Handle the Event when the event is triggered, all listeners will
     * complete before the event is returned to the EventDispatcher.
     */
    public function process(object $event)
    {
        $data = $event->data;
        // TODO KAFKA处理有问题
        $this->kafkaProducer->send('serverlog', json_encode($data, JSON_THROW_ON_ERROR), 'data');
    }
}
