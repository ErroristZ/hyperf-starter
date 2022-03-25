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
     * @param $menuid
     * @return array
     */
    public function list($menuid): array
    {
        if ($menuid) {
            $list = Permission::query()->where('id', $menuid)->first();
            if (isset($list['parent_id'])) {
                $list['parent_id'] = $list['parent_id'] ? explode(',', $list['parent_id']) : [];
            }
        } else {
            $list = Permission::query()->orderByDesc('id')->get()->toArray();
        }

        return $this->buildSuccess($list);
    }
}
