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

if (!function_exists('objToArray')) {
    /**
     * 对象转数组
     * @param string $data
     * @return array|mixed
     * @throws JsonException
     */
    function objToArray(string $data = '')
    {
        if (empty($data)) {
            return [];
        }

        return json_decode(json_encode($data, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
    }
}