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
use App\Service\Admin\RolesService;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Phper666\JWTAuth\Middleware\JWTAuthDefaultSceneMiddleware;

/**
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="staff/role")
 * @Middleware(CasbinMiddleware::class)
 * @Middleware(ServerlogLogMiddleware::class)
 * Class AuthController
 */
class RolesController extends AbstractController
{
    /**
     * FunctionName：list
     * Description：角色列表.
     * @GetMapping(path="list")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang.
     */
    public function list(RolesService $service): array
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
     * Description：.
     * @PostMapping(path="add")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang.
     */
    public function add(RolesService $service): array
    {
        $params = [
            'name' => $this->request->input('name'),
            'description' => $this->request->input('description'),
        ];

        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
        $message = [
            'name.required' => ' 角色名称缺失',
            'description.required' => ' 描述缺失',
        ];
        $this->validate($params, $rules, $message);
        return $service->add($this->request);
    }

    /**
     * FunctionName：update
     * Description：.
     * @PutMapping(path="update")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang.
     */
    public function update(RolesService $service): array
    {
        $params = [
            'id' => $this->request->input('id'),
            'name' => $this->request->input('name'),
            'description' => $this->request->input('description'),
        ];

        $this->validate($params, [
            'id' => 'required|exists:roles,id',
            'name' => 'required',
            'description' => 'required',
        ], [
            'id.required' => ' ID缺失',
            'name.required' => ' 角色名称缺失',
            'description.required' => ' 描述缺失',
            'id.exists' => ' ID不存在',
        ]);
        return $service->update($this->request);
    }

    /**
     * FunctionName：revealRolePermissions
     * Description：.
     * @GetMapping(path="allotPermissions")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang.
     */
    public function revealRolePermissions(RolesService $service): array
    {
        $params = [
            'roleId' => $this->request->input('roleId'),
        ];

        $this->validate($params, [
            'roleId' => 'required',
        ], [
            'roleId.required' => ' ID缺失',
        ]);
        return $service->revealRolePermissions($this->request);
    }

    /**
     * FunctionName：setRolePermissions
     * Description：.
     * @PostMapping(path="setRolePermissions")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang.
     */
    public function setRolePermissions(RolesService $service): array
    {
        $params = [
            'roleId' => $this->request->input('roleId'),
        ];

        $this->validate($params, [
            'roleId' => 'required',
        ], [
            'roleId.required' => ' ID缺失',
        ]);
        return $service->setRolePermissions($this->request);
    }

    /**
     * FunctionName：delete
     * Description：.
     * @DeleteMapping(path="delete")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * Author：zhangkang.
     */
    public function delete(RolesService $service): array
    {
        $params = [
            'id' => $this->request->input('id'),
        ];

        $this->validate($params, [
            'id' => 'required|exists:roles,id',
        ], [
            'id.required' => ' ID缺失',
            'id.exists' => ' ID不存在',
        ]);
        return $service->delete($this->request);
    }
}
