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
use App\Model\ServerlogLog;

class ServerlogService extends AbstractController
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

        $list = new ServerlogLog();

        $list = $list::query()->orderBy('created_at', 'desc')->paginate($limit, ['*'], 'page', $page);

        return $this->paginate($list);
    }
}
