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
use App\Service\Admin\UserService;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Phper666\JWTAuth\Middleware\JWTAuthDefaultSceneMiddleware;

/**
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="staff/user")
 * @Middleware(CasbinMiddleware::class)
 * @Middleware(ServerlogLogMiddleware::class)
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
     * FunctionName：details
     * Description：
     * Author：zhangkang.
     * @GetMapping(path="details")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     */
    public function details(UserService $service): array
    {
        $params = [
            'id' => $this->request->input('id'),
        ];

        $this->validate($params, [
            'id' => 'required|exists:users,id',
        ], [
            'id.required' => ' ID缺失',
            'id.exists' => ' ID不存在',
        ]);
        return $service->details($this->request);
    }

    /**
     * FunctionName：add
     * Description：
     * Author：zhangkang.
     * @PostMapping(path="add")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     */
    public function add(UserService $service): array
    {
        $params = [
            'mobile' => $this->request->input('mobile'),
            'nickname' => $this->request->input('nickname'),
            'username' => $this->request->input('username'),
            'status' => $this->request->input('status'),
            'password' => $this->request->input('password'),
            'name' => $this->request->input('name'),
            'position' => $this->request->input('position'),
            'email' => $this->request->input('email'),
        ];

        $this->validate($params, [
            'mobile' => 'required|unique:users',
            'nickname' => 'required',
            'username' => 'required',
            'status' => 'required',
            'password' => 'required',
            'name' => 'required|unique:users',
            'position' => 'required',
            'email' => 'required|unique:users',
        ], [
            'mobile.required' => ' 手机号缺失',
            'nickname.required' => ' 姓名缺失',
            'username.required' => ' 用户名缺失',
            'status.required' => ' 状态缺失',
            'password.required' => ' 密码缺失',
            'name.required' => ' 账号缺失',
            'position.required' => ' 职位缺失',
            'email.required' => ' 邮箱缺失',
        ]);
        return $service->add($this->request);
    }

    /**
     * FunctionName：update
     * Description：
     * Author：zhangkang.
     * @PutMapping(path="update")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     */
    public function update(UserService $service): array
    {
        $params = [
            'id' => $this->request->input('id'),
            'mobile' => $this->request->input('mobile'),
            'nickname' => $this->request->input('nickname'),
            'username' => $this->request->input('username'),
            'status' => $this->request->input('status'),
            'avatar' => $this->request->input('avatar'),
            'name' => $this->request->input('name'),
            'position' => $this->request->input('position'),
            'email' => $this->request->input('email'),
        ];

        $this->validate($params, [
            'id' => 'required|exists:users,id',
            'mobile' => 'required',
            'nickname' => 'required',
            'username' => 'required',
            'status' => 'required',
            'avatar' => 'required',
            'name' => 'required',
            'position' => 'required',
            'email' => 'required',
        ], [
            'id.required' => ' ID缺失',
            'id.exists' => ' ID不存在',
            'mobile.required' => ' 手机号缺失',
            'nickname.required' => ' 姓名缺失',
            'username.required' => ' 用户名缺失',
            'status.required' => ' 状态缺失',
            'avatar.required' => ' 头像缺失',
            'name.required' => ' 账号缺失',
            'position.required' => ' 职位缺失',
            'email.required' => ' 邮箱缺失',
        ]);
        return $service->update($this->request);
    }

    /**
     * FunctionName：status
     * Description：
     * Author：zhangkang.
     * @PutMapping(path="status")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     */
    public function status(UserService $service): array
    {
        $params = [
            'id' => $this->request->input('id'),
            'status' => $this->request->input('status'),
        ];

        $this->validate($params, [
            'id' => 'required|exists:users,id',
            'status' => 'required',
        ], [
            'id.required' => ' ID缺失',
            'id.exists' => ' ID不存在',
            'status.required' => ' 状态缺失',
        ]);
        return $service->status($this->request);
    }

    /**
     * FunctionName：all
     * Description：
     * Author：zhangkang.
     * @GetMapping(path="all")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     */
    public function all(UserService $service): array
    {
        return $service->all();
    }

    /**
     * FunctionName：stting
     * Description：.
     * @GetMapping(path="stting")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang
     */
    public function stting(UserService $service): array
    {
        return $service->stting($this->request);
    }

    /**
     * FunctionName：stting
     * Description：.
     * @PutMapping(path="stting/update")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang
     */
    public function sttingUpdate(UserService $service): array
    {
        $params = [
            'mobile' => $this->request->input('mobile'),
            'nickname' => $this->request->input('nickname'),
            'avatar' => $this->request->input('avatar'),
        ];

        $this->validate($params, [
            'mobile' => 'required',
            'nickname' => 'required',
            'avatar' => 'required',
        ], [
            'mobile.required' => ' 手机号缺失',
            'nickname.required' => ' 用户名缺失',
            'avatar.required' => ' 头像缺失',
        ]);
        return $service->sttingUpdate($this->request);
    }
}
