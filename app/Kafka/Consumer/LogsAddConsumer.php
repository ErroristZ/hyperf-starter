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
namespace App\Kafka\Consumer;

use App\Model\ServerlogLogSearchable;
use Hyperf\Kafka\AbstractConsumer;
use Hyperf\Kafka\Annotation\Consumer;
use longlang\phpkafka\Consumer\ConsumeMessage;

/**
 * @Consumer(topic="serverlog", nums=1, groupId="serverlogGroup", autoCommit=true)
 */
class LogsAddConsumer extends AbstractConsumer
{
    public function consume(ConsumeMessage $message)
    {
        // TODO kafka下同步不了模型全文检索
        $data = json_decode($message->getValue(), true, 512, JSON_THROW_ON_ERROR);

        if (! empty($data)) {
            $log = new ServerlogLogSearchable();

            $log->user_id = $data['user_id'];
            $log->user_name = $data['user_name'];
            $log->url = $data['url'];
            $log->ip = $data['ip'];
            $log->content = $data['content'];
            $log->save();
        }
    }
}
