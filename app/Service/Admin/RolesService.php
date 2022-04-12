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
namespace App\Service\Admin;

use App\Controller\AbstractController;
use App\Model\Permission;
use App\Model\Role;
use App\Model\RolePermission;
use Donjan\Casbin\Enforcer;

class RolesService extends AbstractController
{
    /**
     * FunctionName：list
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function list($request): array
    {
        $page = (int) $request->input('page', 1);
        $limit = (int) $request->input('limit', 10);

        $list = Role::query();

        if ($request->input('name')) {
            $list->where('name', 'like', "%{$request->input('name')}%");
        }

        $list = $list->orderByDesc('id')->paginate($limit, ['*'], 'page', $page);

        return $this->paginate($list);
    }

    /**
     * FunctionName：add
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function add($request): array
    {
        Role::query()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return $this->buildSuccess();
    }

    /**
     * FunctionName：update
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function update($request): array
    {
        Role::query()->where('id', $request->input('id'))->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return $this->buildSuccess();
    }

    /**
     * FunctionName：revealRolePermissions
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function revealRolePermissions($request): array
    {
        $menu = Permission::query()->get(['id', 'parent_id', 'name'])->toArray();

        $permissions = RolePermission::query()->where([
            'roleId' => $request->input('roleId'),
        ])->get(['menuId', 'pseudoChecked'])->toArray();

        return $this->buildSuccess(['menu' => $menu, 'permissions' => $permissions]);
    }

    /**
     * FunctionName：setRolePermissions
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function setRolePermissions($request): array
    {
        $name = Role::query()->where('id', $request->input('roleId'))->value('name');

        $arrOperationBefore = RolePermission::query()->where([
            'roleId' => $request->input('roleId'),
        ])->get(['menuId', 'pseudoChecked'])->toArray();

        if ($arrOperationBefore) {
            RolePermission::query()->where('roleId', $request->input('roleId'))->delete();
            Enforcer::deletePermissionsForUser($name);
        }

        $arrSet = [];
        foreach ($request->input('permissionsData') as $v) {
            $arrSet[] = [
                'roleId' => $request->input('roleId'),
                'menuId' => $v['menuId'],
                'pseudoChecked' => intval($v['pseudoChecked']),
            ];

            if ($v['menuId']) {
                $item = Permission::query()->where('id', $v['menuId'])->first(['description', 'method']);

                Enforcer::addPermissionForUser($name, $item->description, $item->method);
            }
        }

        if ($arrSet) {
            RolePermission::insert($arrSet);
        }

        return $this->buildSuccess();
    }

    /**
     * FunctionName：delete
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function delete($request): array
    {
        Role::query()->where('id', $request->input('id'))->delete();

        return $this->buildSuccess();
    }
}
