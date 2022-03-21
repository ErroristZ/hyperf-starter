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
namespace App\Model;

use Hyperf\DbConnection\Model\Model as BaseModel;

abstract class Model extends BaseModel
{
    public const STATUS_DELETED = -1; // status 为-1表示删除

    public const STATUS_DISABLE = 0; // status 为0表示未启用

    public const STATUS_ENABLE = 1; // status 为1表示正常

    public static array $status = [
        0 => '禁用',
        1 => '正常',
    ];

    protected $guarded = ['id'];

    public function getFormatState($key = 0, $enum = [], $default = '')
    {
        return array_key_exists($key, $enum) ? $enum[$key] : $default;
    }
}
