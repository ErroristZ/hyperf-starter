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

class PermissionService extends AbstractController
{
    /**
     * FunctionName：list
     * Description：
     * Author：zhangkang.
     */
    public function list(): array
    {
        return $this->buildSuccess(Permission::query()->orderBy('id')->get()->toArray());
    }

    /**
     * FunctionName：menu
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function menu($request): array
    {
        return $this->buildSuccess(Permission::query()->where('id', $request->input('id'))->first());
    }

    /**
     * FunctionName：add
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function add($request): array
    {
        $arrSet = [
            'parent_id' => $request->input('parent_id') ?? 0,
            'name' => $request->input('name'),
            'icon' => $request->input('icon') ?? '',
            'route' => $request->input('route') ?? '',
            'path' => $request->input('path') ?? '',
            'menuType' => $request->input('menuType'),
            'method' => $request->input('method'),
            'description' => $request->input('description'),
            'sort' => $request->input('sort') ?? 1,
            'is_display' => 0,
        ];

        Permission::insert($arrSet);

        return $this->buildSuccess();
    }

    /**
     * FunctionName：edit
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function edit($request): array
    {
        $arrSet = [
            'parent_id' => $request->input('parent_id') ?? 0,
            'name' => $request->input('name'),
            'icon' => $request->input('icon') ?? '',
            'route' => $request->input('route') ?? '',
            'path' => $request->input('path') ?? '',
            'menuType' => $request->input('menuType'),
            'method' => $request->input('method'),
            'description' => $request->input('description'),
            'sort' => $request->input('sort') ?? 1,
            'is_display' => $request->input('is_display'),
        ];

        Permission::query()->where('id', $request->input('id'))->update($arrSet);

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
        Permission::query()->where('id', $request->input('id'))->delete();

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
        Permission::query()->where('id', $request->input('id'))->update(['is_display' => $request->input('is_display')]);

        return $this->buildSuccess();
    }
}
