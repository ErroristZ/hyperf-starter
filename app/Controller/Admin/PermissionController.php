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
use App\Service\Admin\PermissionService;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Phper666\JWTAuth\Middleware\JWTAuthDefaultSceneMiddleware;

/**
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="staff/menu")
 * @Middleware(CasbinMiddleware::class)
 * @Middleware(ServerlogLogMiddleware::class)
 * Class AuthController
 */
class PermissionController extends AbstractController
{
    /**
     * FunctionName：list
     * Description：菜单列表.
     * @GetMapping(path="list")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang.
     */
    public function list(PermissionService $service): array
    {
        return $service->list();
    }

    /**
     * FunctionName：menu
     * Description：查询菜单
     * Author：zhangkang.
     * @GetMapping(path="menu")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     */
    public function menu(PermissionService $service): array
    {
        $params = [
            'id' => $this->request->input('id'),
        ];

        $this->validate($params, [
            'id' => 'required|exists:permissions,id',
        ], [
            'id.required' => ' ID缺失',
            'id.exists' => ' ID不存在',
        ]);
        return $service->menu($this->request);
    }

    /**
     * FunctionName：add
     * Description：添加菜单
     * Author：zhangkang.
     * @PostMapping(path="add")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     */
    public function add(PermissionService $service): array
    {
        $params = [
            'name' => $this->request->input('name'),
            'description' => $this->request->input('description'),
        ];

        $this->validate($params, [
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => '菜单名称缺失',
            'description.required' => '权限辨别缺失',
        ]);
        return $service->add($this->request);
    }

    /**
     * FunctionName：edit
     * Description：编辑菜单
     * Author：zhangkang.
     * @PutMapping(path="edit")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     */
    public function edit(PermissionService $service): array
    {
        $params = [
            'id' => $this->request->input('id'),
            'name' => $this->request->input('name'),
            'description' => $this->request->input('description'),
        ];

        $this->validate($params, [
            'id' => 'required|exists:permissions,id',
            'name' => 'required',
            'description' => 'required|unique:permissions',
        ], [
            'id.required' => 'ID缺失',
            'name.required' => '菜单名称缺失',
            'description.required' => '权限辨别缺失',
            'id.exists' => ' ID不存在',
        ]);
        return $service->edit($this->request);
    }

    /**
     * FunctionName：delete
     * Description：.
     * @DeleteMapping(path="delete")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang.
     */
    public function delete(PermissionService $service): array
    {
        $params = [
            'id' => $this->request->input('id'),
        ];

        $this->validate($params, [
            'id' => 'required|exists:permissions,id',
        ], [
            'id.required' => ' ID缺失',
            'id.exists' => ' ID不存在',
        ]);
        return $service->delete($this->request);
    }

    /**
     * FunctionName：update
     * Description：.
     * @PutMapping(path="update")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang.
     */
    public function update(PermissionService $service): array
    {
        $params = [
            'id' => $this->request->input('id'),
            'is_display' => $this->request->input('is_display'),
        ];

        $this->validate($params, [
            'id' => 'required|exists:permissions,id',
            'is_display' => 'required',
        ], [
            'id.required' => 'ID缺失',
            'is_display.required' => '状态缺失',
            'id.exists' => ' ID不存在',
        ]);
        return $service->update($this->request);
    }
}
