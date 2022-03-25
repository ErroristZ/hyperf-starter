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
use App\Service\Admin\PermissionService;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Phper666\JWTAuth\Middleware\JWTAuthDefaultSceneMiddleware;

/**
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="staff/menu")
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
        $params = [
            'menuid' => $this->request->input('menuid') ?? 0,
        ];

        $rules = [
            'menuid' => 'required',
        ];
        $message = [
            'menuid.required' => ' menuid',
        ];
        $this->validate($params, $rules, $message);

        return $service->list($this->request->input('menuid'));
    }
}
