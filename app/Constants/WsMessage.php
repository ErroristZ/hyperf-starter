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

class WsMessage
{
    /**
     * @Message("用户上线")
     */
    public const FRIEND_ONLINE_MESSAGE = 'friend_online_message';

    /**
     * @Message("用户下线")
     */
    public const FRIEND_OFFLINE_MESSAGE = 'friend_offline_message';
}
