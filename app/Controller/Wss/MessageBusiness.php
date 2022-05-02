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
namespace App\Controller\Wss;

use App\Model\Message;
use App\Model\MessageUser;
use App\Service\Redis\RedisClientService;
use Phper666\JWTAuth\Util\JWTUtil;

class MessageBusiness
{
    /**
     * FunctionName：bind
     * Description：
     * Author：zhangkang.
     * @param $frame
     * @param $arrParam
     */
    public static function bind($frame, $arrParam): array
    {
        $strToken = str_replace('Bearer ', '', $arrParam['data']['token']);
        if (! $strToken) {
            return callbackParam(403, false, [], 'token can not be empty!');
        }

        $user = JWTUtil::getParser()->parse($strToken)->claims()->all();
        $redis = new RedisClientService();
        $redis->savaUserID((string) $frame->fd, $user['uid']);

        $list = MessageUser::query();
        $list->where('user_id', $user['uid']);

        $arrParam['data'] = ['fd' => $frame->fd, 'notReadTotal' => $list->where('isRead', 0)->count()];
        return callbackParam(200, true, $arrParam, 'bind success!');
    }

    /**
     * FunctionName：heartbeat
     * Description：
     * Author：zhangkang.
     * @param $frame
     * @param $arrParam
     */
    public static function heartbeat($frame, $arrParam): array
    {
        $strToken = str_replace('Bearer ', '', $arrParam['data']['token']);
        if (! $strToken) {
            return callbackParam(403, false, [], 'token can not be empty!');
        }

        $user = JWTUtil::getParser()->parse($strToken)->claims()->all();
        $redis = new RedisClientService();
        $redis->savaUserID((string) $frame->fd, $user['uid']);

        return callbackParam(200, true, $arrParam, 'bind success!');
    }

    /**
     * FunctionName：fetch
     * Description：
     * Author：zhangkang.
     * @param $frame
     * @param $arrParam
     */
    public static function fetch($frame, $arrParam): array
    {
        $redis = new RedisClientService();
        $user_id = $redis->findUserId((string) $frame->fd);
        $intPage = intval($arrParam['data']['page']);
        $intLimit = intval($arrParam['data']['limit']);
        $intType = intval($arrParam['data']['type']);

        $list = Message::query();
        $list->where('message.type', $intType);
        $list->where('message_user.user_id', $user_id);
        $list->join('message_user', 'message_user.message_id', 'message.id');

        $arrParam['data'] = [
            'list' => $list->orderByDesc('message.id')->paginate($intLimit, ['*'], 'page', $intPage)->items(),
            'total' => $list->orderByDesc('message.id')->paginate($intLimit, ['*'], 'page', $intPage)->total(),
            'notReadTotal' => $list->where('message_user.isRead', 0)->count(),
        ];
        return callbackParam(200, true, $arrParam);
    }

    /**
     * FunctionName：resetNotReadTotal
     * Description：
     * Author：zhangkang.
     * @param $arrParam
     */
    public static function resetNotReadTotal($arrParam): array
    {
        $strToken = str_replace('Bearer ', '', $arrParam['data']['token']);
        if (! $strToken) {
            return callbackParam(403, false, [], 'token can not be empty!');
        }

        return callbackParam(200, true, $arrParam, 'bind success!');
    }
}
