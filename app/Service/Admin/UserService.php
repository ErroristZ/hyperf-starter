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

use App\Event\UserLogin;
use App\Model\User;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

class UserService
{
    /**
     * @Inject
     */
    private EventDispatcherInterface $eventDispatcher;

    /**
     * FunctionName：loginLog
     * Description：
     * Author：zhangkang.
     * @param object $user
     */
    public function loginLog(object $user)
    {
        $this->eventDispatcher->dispatch(new UserLogin($user));
    }

    /**
     * FunctionName：checkUser
     * Description：
     * Author：zhangkang.
     */
    public static function checkUser(RequestInterface $request): bool
    {
        $userInfo = $request->all();

        if (! $user = User::query()->where('name', $userInfo['name'])
            ->orWhere('mobile', $userInfo['name'])->first()) {
            return false;
        }

        if (password_verify($userInfo['password'], $user->password) === false) {
            return false;
        }

        $userInfo['password'] = password_hash($userInfo['password'], PASSWORD_BCRYPT);

        $user['header'] = $request->header('User-Agent');
        $user['url'] = $request->getRequestUri();
        $user['info'] = json_encode($userInfo, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
        $user['ip'] = $request->server('remote_addr');

        (new self())->loginLog($user);

        return true;
    }
}
