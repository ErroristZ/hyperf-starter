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
namespace App\Controller;

use App\Controller\Wss\MessageBusiness;
use App\Service\Redis\RedisClientService;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Hyperf\Utils\Codec\Json;
use Swoole\Http\Request;
use Swoole\Websocket\Frame;

class WebSocketController extends AbstractController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    /**
     * FunctionName：onMessage
     * Description：用户发送信息
     * Author：zhangkang.
     * @param $server
     */
    public function onMessage($server, Frame $frame): void
    {
        $arrParam = Json::decode($frame->data);
        $data = [];

        switch ($arrParam['cmd']) {
            case 'message.bind':
                $data = MessageBusiness::bind($frame, $arrParam);
            break;
            case 'message.heartbeat':
                $data = MessageBusiness::heartbeat($frame, $arrParam);
                break;
            case 'message.fetch':
                $data = MessageBusiness::fetch($frame, $arrParam);
                break;
            case 'message.resetNotReadTotal':
                $data = MessageBusiness::resetNotReadTotal($arrParam);
                break;
        }

        $server->push($frame->fd, Json::encode($data));
    }

    /**
     * FunctionName：onOpen
     * Description：用户连接服务器
     * Author：zhangkang.
     * @param $server
     */
    public function onOpen($server, Request $request): void
    {
        $server->push($request->fd, Json::encode($this->buildSuccess()));
    }

    /**
     * FunctionName：onClose
     * Description： 用户关闭连接
     * Author：zhangkang.
     * @param $server
     */
    public function onClose($server, int $fd, int $reactorId): void
    {
        $redis = new RedisClientService();
        $uid = $redis->findUserId((string) $fd);
        // 删除在线列表中的用户
        $redis->delUserId((string) $uid, (string) $fd);
    }
}
