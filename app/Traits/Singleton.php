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
namespace App\Traits;

use Hyperf\Utils\Context;

/**
 * 构建单例基类
 * Trait Singleton.
 */
trait Singleton
{
    protected $instanceKey;

    public static function getInstance($params = [], $refresh = false)
    {
        $key = static::class;
        $instance = null;
        if (Context::has($key)) {
            $instance = Context::get($key);
        }

        if ($refresh || ! $instance instanceof static) {
            $instance = new static(...$params);
            Context::set($key, $instance);
        }

        return $instance;
    }
}
