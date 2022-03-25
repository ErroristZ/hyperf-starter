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
use App\Service\Admin\UserService;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Phper666\JWTAuth\Middleware\JWTAuthDefaultSceneMiddleware;

/**
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="staff/user")
 * Class AuthController
 */
class UserController extends AbstractController
{
    /**
     * FunctionName：list
     * Description：角色列表.
     * @GetMapping(path="list")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang.
     */
    public function list(UserService $service): array
    {
        $params = [
            'page' => $this->request->input('page') ?? 1,
            'limit' => $this->request->input('limit') ?? 10,
            'name' => $this->request->input('name') ?? '',
            'status' => $this->request->input('status') ?? '',
            'createTime' => $this->request->input('createTime') ?? '',
        ];

        $rules = [
            'page' => 'required',
            'limit' => 'required',
        ];
        $message = [
            'page.required' => ' 页数缺失',
            'limit.required' => ' 条数缺失',
        ];
        $this->validate($params, $rules, $message);
        return $service->list($this->request);
    }
}
