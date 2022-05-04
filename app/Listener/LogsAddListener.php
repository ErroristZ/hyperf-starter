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
use App\Model\ServerlogLog;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\HttpServer\Annotation\AutoController;
use Psr\Container\ContainerInterface;

/**
 * @AutoController
 * @Listener
 */
class LogsAddListener implements ListenerInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
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

        $log = new ServerlogLog();
        $log->user_id = $data['user_id'];
        $log->user_name = $data['user_name'];
        $log->url = $data['url'];
        $log->ip = $data['ip'];
        $log->content = $data['content'];
        $log->save();
    }
}
