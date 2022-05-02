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
namespace App\Constants;

class CodeConstants
{
    public const CASBIN_ERROR = ['code' => 403, 'message' => '无权进行该操作'];

    public const FILE_ERROR = ['code' => 10001, 'message' => '检查文件是否存在'];

    public const FILE_QIQIUYUN_ERROR = ['code' => 10002, 'message' => '文件上传失败'];

    public const HTTP_ACTION_COUNT_ERROR = ['code' => 200302, 'message' => '操作频繁'];

    public const USER_SERVICE_LOGIN_ERROR = ['code' => 200201, 'message' => '登录失败'];

    public const USER_SERVICE_LOGOUT_ERROR = ['code' => 200203, 'message' => '退出登录失败'];

    public const USER_SERVICE_REGISTER_ERROR = ['code' => 200105, 'message' => '注册失败'];

    public const USER_ACCOUNT_REGISTERED = ['code' => 23001, 'message' => '账号已注册'];

    public const CLIENT_NOT_FOUND_HTTP_ERROR = ['code' => 400001, 'message' => '请求失败'];

    public const CLIENT_PARAMETER_ERROR = ['code' => 400200, 'message' => '参数错误'];

    public const CLIENT_CREATED_ERROR = ['code' => 400201, 'message' => '数据已存在'];

    public const CLIENT_DELETED_ERROR = ['code' => 400202, 'message' => '数据不存在'];

    public const ADD_PARAMETER_ERROR = ['code' => 400203, 'message' => '添加失败'];

    public const CLIENT_HTTP_UNAUTHORIZED = ['code' => 401001, 'message' => '授权失败，请先登录'];

    public const CLIENT_HTTP_UNAUTHORIZED_EXPIRED = ['code' => 401200, 'message' => '账号信息已过期，请重新登录'];

    public const CLIENT_HTTP_UNAUTHORIZED_BLACKLISTED = ['code' => 401201, 'message' => '账号在其他设备登录，请重新登录'];

    public const CLIENT_NOT_FOUND_ERROR = ['code' => 405001, 'message' => 'HTTP请求类型错误'];

    public const SYSTEM_ERROR = ['code' => 500001, 'message' => '服务器错误'];

    public const SYSTEM_UNAVAILABLE = ['code' => 500002, 'message' => '服务器正在维护，暂不可用'];

    public const SYSTEM_CACHE_CONFIG_ERROR = ['code' => 500003, 'message' => '缓存配置错误'];

    public const SYSTEM_CACHE_MISSED_ERROR = ['code' => 500004, 'message' => '缓存未命中'];

    public const SYSTEM_CONFIG_ERROR = ['code' => 500005, 'message' => '系统配置错误'];

    public const SERVICE_REGISTER_ERROR = ['code' => 500101, 'message' => '登录失败'];

    public const SERVICE_LOGIN_ERROR = ['code' => 500102, 'message' => '缓存配置错误'];

    public const SERVICE_LOGIN_ACCOUNT_ERROR = ['code' => 500103, 'message' => '账号或密码错误'];

    public const SERVICE_LOGIN_STATUS_ERROR = ['code' => 500103, 'message' => '用户已禁用'];
}
