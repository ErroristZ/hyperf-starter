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
use App\Event\UserLogin;
use App\Model\User;
use Donjan\Casbin\Enforcer;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Phper666\JWTAuth\Util\JWTUtil;
use Psr\EventDispatcher\EventDispatcherInterface;

class UserService extends AbstractController
{
    /**
     * @Inject
     */
    private EventDispatcherInterface $eventDispatcher;

    /**
     * FunctionName：loginLog
     * Description：
     * Author：zhangkang.
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

        if (! $user = User::query()->where('name', $userInfo['name'])->first()) {
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

        $list = User::query();

        if ($request->input('nickname')) {
            $list->where('nickname', 'like', "%{$request->input('nickname')}%");
        }

        if ($request->input('mobile')) {
            $list->where('mobile', 'like', "%{$request->input('mobile')}%");
        }

        if ($request->input('username')) {
            $list->where('username', 'like', "%{$request->input('username')}%");
        }

        if ($request->input('status')) {
            $list->where('status', $request->input('status'));
        }

        if ($request->input('created_at')) {
            $list->where('created_at', $request->input('created_at'));
        }

        $list = $list->orderByDesc('id')->paginate($limit, ['*'], 'page', $page);

        foreach ($list as $key => $value) {
            $list[$key]['roleIds'] = Enforcer::getRolesForUser($value->name);
        }

        return $this->paginate($list);
    }

    /**
     * FunctionName：details
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function details($request): array
    {
        $data = User::query()->where('id', $request->input('id'))->first(['id', 'name', 'mobile', 'nickname', 'username', 'email', 'position', 'status', 'avatar']);

        $data['roleIds'] = Enforcer::getRolesForUser($data->name);

        return $this->buildSuccess($data);
    }

    /**
     * FunctionName：add
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function add($request): array
    {
        User::query()->create([
            'username' => $request->input('username'),
            'mobile' => $request->input('mobile'),
            'nickname' => $request->input('nickname'),
            'password' => password_hash($request->input('password'), PASSWORD_BCRYPT),
            'status' => $request->input('status'),
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'email' => $request->input('email'),
            'ip' => '0.0.0.0',
        ]);

        foreach ($request->input('roleIds') as $v) {
            Enforcer::addRoleForUser($request->input('name'), $v);
        }

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
        User::query()->where('id', JWTUtil::getParserData($request)['uid'])->update([
            'username' => $request->input('username'),
            'mobile' => $request->input('mobile'),
            'nickname' => $request->input('nickname'),
            'avatar' => $request->input('avatar'),
            'status' => $request->input('status'),
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'email' => $request->input('email'),
        ]);

        /*
         * 先删除用户所有角色，再次用户添加角色
         */
        Enforcer::deleteRolesForUser($request->input('name'));
        foreach ($request->input('roleIds') as $v) {
            Enforcer::addRoleForUser($request->input('name'), $v);
        }

        return $this->buildSuccess();
    }

    /**
     * FunctionName：status
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function status($request): array
    {
        User::query()->where('id', $request->input('id'))->update([
            'status' => $request->input('status'),
        ]);

        return $this->buildSuccess();
    }

    /**
     * FunctionName：all
     * Description：
     * Author：zhangkang.
     * @return array
     */
    public function all()
    {
        $list = User::query()->select('id', 'name', 'mobile', 'nickname')->get();
        return $this->buildSuccess($list);
    }

    /**
     * FunctionName：stting
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function stting($request): array
    {
        $data = User::query()->where('id', JWTUtil::getParserData($request)['uid'])->first(['id', 'mobile', 'nickname', 'avatar']);

        return $this->buildSuccess($data);
    }

    /**
     * FunctionName：sttingUpdate
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function sttingUpdate($request): array
    {
        $user = User::query()->find(1);

        $user->where('id', JWTUtil::getParserData($request)['uid']);
        $user->mobile = $request->input('mobile');
        $user->nickname = $request->input('nickname');
        $user->avatar = $request->input('avatar');

        if ($request->input('password')) {
            $user->password = $request->input('password');
        }

        $user->save();

        return $this->buildSuccess();
    }
}
