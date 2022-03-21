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

use App\Constants\CodeConstants;
use App\Constants\UserCode;
use App\Controller\AbstractController;
use App\Model\Permission;
use App\Model\User;
use Donjan\Casbin\Enforcer;
use Hyperf\Di\Annotation\Inject;
use JsonException;
use Phper666\JWTAuth\JWT;
use Phper666\JWTAuth\Util\JWTUtil;
use Psr\SimpleCache\InvalidArgumentException;

class AuthService extends AbstractController
{
    /**
     * @Inject
     */
    protected JWT $jwt;

    /**
     * FunctionName：login
     * Description：登录
     * Author：zhangkang.
     * @param $request
     * @return array
     * @throws InvalidArgumentException
     * @throws JsonException
     */
    public function login($request): array
    {
        if (UserService::checkUser($request) === true) {
            $user = User::query()->where('name', $request->input('name'))->first(['id', 'username', 'status']);

            if ($user->status == UserCode::STATUS_ENABLE) {
                return $this->buildFailed(CodeConstants::SERVICE_LOGIN_STATUS_ERROR);
            }

            $token = $this->jwt->getToken('default', ['uid' => $user->id, 'username' => $user->username]);
            $data = [
                'token' => $token->toString(),
                'expireAt' => $this->jwt->getTTL($token->toString()),
            ];

            return $this->buildSuccess($data);
        }
        return $this->buildFailed(CodeConstants::SERVICE_LOGIN_ACCOUNT_ERROR);
    }

    /**
     * FunctionName：refreshToken
     * Description：刷新jwt
     * Author：zhangkang.
     * @throws InvalidArgumentException
     */
    public function refreshToken(): array
    {
        $token = $this->jwt->refreshToken();
        $data = [
            'token' => $token->toString(),
            'exp' => $this->jwt->getTTL($token->toString()),
        ];
        return $this->buildSuccess($data);
    }

    /**
     * FunctionName：logout
     * Description：退出登录
     * Author：zhangkang.
     * @throws InvalidArgumentException
     */
    public function logout(): array
    {
        $this->jwt->logout();
        return $this->buildSuccess([]);
    }

    /**
     * FunctionName：initialization
     * Description：初始化操作
     * Author：zhangkang.
     * @param mixed $request
     */
    public function initialization($request): array
    {
        $user = User::query()->where('id', JWTUtil::getParserData($request)['uid'])->first(['id', 'username','avatar', 'nickname', 'position']);

        $user['timeFix'] = getHello() . '，' . $user->nickname . '，欢迎回来';

        $data = [
            'user_info' => $user,
            'permission' => $this->getMenuList($user)
        ];
        return $this->buildSuccess($data);
    }

    /**
     * FunctionName：getMenuList
     * Description：
     * Author：zhangkang
     * @param object $user
     * @return array
     */
    protected function getMenuList(object $user): array
    {
        $allPermissions = [];
        if (empty($user)) {
            return $allPermissions;
        }

        // 判断当前登录用户是否为超级管理员,如果是的话返回所有权限
        if ($user->id == config('super_admin')) {
            $permission = Permission::query()->orderBy('sort', 'asc')->get()->toArray();
        } else {
            $permission =  Enforcer::GetImplicitPermissionsForUser($user->username);
        }

        return $permission;
    }
}
