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

use App\Middleware\ServerlogLogMiddleware;
use App\Request\UserResquest;
use App\Service\Admin\AuthService;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use JsonException;
use Phper666\JWTAuth\Middleware\JWTAuthDefaultSceneMiddleware;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="staff")
 * Class AuthController
 */
class AuthController
{
    protected AuthService $service;

    protected RequestInterface $request;

    public function __construct(AuthService $service, RequestInterface $request)
    {
        $this->service = $service;
        $this->request = $request;
    }

    /**
     * FunctionName：login
     * Description：登录.
     * @PostMapping(path="login")
     * Author：zhangkang.
     *@throws InvalidArgumentException|JsonException
     */
    public function login(UserResquest $request): array
    {
        return $this->service->login($request);
    }

    /**
     * FunctionName：refreshToken
     * Description：刷新jwt.
     * @PostMapping(path="refresh")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * @Middleware(ServerlogLogMiddleware::class)
     * Author：zhangkang.
     * @throws InvalidArgumentException
     */
    public function refreshToken(): array
    {
        return $this->service->refreshToken();
    }

    /**
     * FunctionName：logout
     * Description：退出登录.
     * @PostMapping(path="logout")
     * Author：zhangkang.
     * @throws InvalidArgumentException
     */
    public function logout(): array
    {
        return $this->service->logout();
    }

    /**
     * FunctionName：initialization
     * Description：初始化操作.
     * @GetMapping(path="initialization")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * @Middleware(ServerlogLogMiddleware::class)
     * Author：zhangkang.
     */
    public function initialization(): array
    {
        return $this->service->initialization($this->request);
    }

    /**
     * FunctionName：routers
     * Description：获取权限.
     * @GetMapping(path="routers")
     * @Middleware(JWTAuthDefaultSceneMiddleware::class)
     * @Middleware(ServerlogLogMiddleware::class)
     * Author：zhangkang.
     */
    public function routers(): array
    {
        return $this->service->routers($this->request);
    }
}
