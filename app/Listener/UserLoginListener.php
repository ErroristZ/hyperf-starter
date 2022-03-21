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

use App\Event\UserLogin;
use App\Model\Log;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;

/**
 * @Listener
 */
class UserLoginListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            UserLogin::class,
        ];
    }

    public function process(object $event)
    {
        Log::create([
            'user_id' => $event->user->id,
            'action' => 'login',
            'url' => $event->user->url,
            'info' => $event->user->info,
            'ip' => $event->user->ip,
            'user_agent' => $event->user->header,
        ]);
    }
}
