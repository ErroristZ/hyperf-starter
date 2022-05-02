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
namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Middleware\CasbinMiddleware;
use App\Middleware\ServerlogLogMiddleware;
use App\Service\Admin\MessageService;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Phper666\JWTAuth\Middleware\JWTAuthDefaultSceneMiddleware;

/**
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="staff/message")
 * @Middleware(CasbinMiddleware::class)
 * @Middleware(ServerlogLogMiddleware::class)
 * Class MessageController
 */
class MessageController extends AbstractController
{
    /**
     * FunctionName：list
     * Description：消息列表.
     * @GetMapping(path="list")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang.
     */
    public function list(MessageService $service): array
    {
        $params = [
            'page' => $this->request->input('page') ?? 1,
            'limit' => $this->request->input('limit') ?? 10,
        ];

        $this->validate($params, [
            'page' => 'required',
            'limit' => 'required',
        ], [
            'page.required' => ' 页数缺失',
            'limit.required' => ' 条数缺失',
        ]);
        return $service->list($this->request);
    }

    /**
     * FunctionName：add
     * Description：添加消息
     * Author：zhangkang.
     * @PostMapping(path="add")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     */
    public function add(MessageService $service): array
    {
        $params = [
            'title' => $this->request->input('title'),
            'content' => $this->request->input('content'),
            'type' => $this->request->input('type'),
        ];

        $this->validate($params, [
            'title' => 'required',
            'content' => 'required',
            'type' => 'required',
        ], [
            'title.required' => '标题名称缺失',
            'content.required' => '消息内容缺失',
            'type.required' => '消息类型缺失',
        ]);
        return $service->add($this->request);
    }
}
