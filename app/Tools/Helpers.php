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
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Context;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

if (! function_exists('di')) {
    /**
     * Finds an entry of the container by its identifier and returns it.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @return ContainerInterface|mixed
     */
    function di(?string $id = null): mixed
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }

        return $container;
    }
}

/**
 * 获取欢迎语.
 */
function getHello(): string
{
    // 获取当前时间的 小时 单位
    $h = date('H');
    if ($h < 6) {
        $time = '凌晨好';
    } elseif ($h < 9) {
        $time = '早上好';
    } elseif ($h < 12) {
        $time = '上午好';
    } elseif ($h < 14) {
        $time = '中午好';
    } elseif ($h < 17) {
        $time = '下午好';
    } elseif ($h < 19) {
        $time = '傍晚好';
    } elseif ($h < 22) {
        $time = '晚上好';
    } else {
        $time = '深夜好';
    }
    return $time;
}

/**
 * 判断数组下标是否设置未设置返回默认值
 * @param $strKey
 * @param null $defaultValue
 * @return null|mixed
 */
function issetArrKey(array $arrData, $strKey, $defaultValue = null, bool $booleValIsExist = true)
{
    if (isset($arrData[$strKey]) && $booleValIsExist && $arrData[$strKey]) {
        return $arrData[$strKey];
    }
    return $defaultValue;
}

/**
 * 将数组指定的下标值作为键名.
 */
function arrayValueToKey(array $arrData, string $strKey, array $arrFormatJsonKey = []): array
{
    $arrReturn = [];
    foreach ($arrFormatJsonKey as $formatName) {
        foreach ($arrData as $k => $v) {
            if (isset($v[$formatName])) {
                $arrData[$k][$formatName] = json_decode($v[$formatName], true, 512, JSON_THROW_ON_ERROR);
            }
        }
    }
    foreach ($arrData as $k => $v) {
        $arrReturn[$v[$strKey]] = $v;
    }
    return $arrReturn;
}

/**
 * 对数组进行分组聚合.
 * @param $keys
 */
function arrayGroupBy(array $array, $keys): array
{
    if (! $array) {
        return [];
    }
    if (! is_array($keys) || count($keys) == 1) {
        $key = is_array($keys) ? array_shift($keys) : $keys;
        return array_reduce($array, function ($tmp_result, $item) use ($key) {
            $tmp_result[$item[$key]][] = $item;
            return $tmp_result;
        });
    }

    $keys = array_values($keys);
    $result = arrayGroupBy($array, array_shift($keys));
    foreach ($result as $k => $value) {
        $result[$k] = arrayGroupBy($value, $keys);
    }
    return $result;
}

if (! function_exists('conSet')) {
    /**
     * 设置协程上下文.
     * @param $value
     */
    function conSet(string $id, $value): mixed
    {
        return Context::set($id, $value);
    }
}

if (! function_exists('conGet')) {
    /**
     * 获取协程上下文.
     * @param $default
     */
    function conGet(string $id, $default = null): mixed
    {
        return Context::get($id, $default);
    }
}

/**
 * FunctionName：callbackParam
 * Description：
 * Author：zhangkang.
 * @param $data
 */
function callbackParam(int $intCode, bool $boolSuccess, $data, string $strMsg = null): array
{
    $arrReturn = ['code' => $intCode, 'success' => $boolSuccess, 'data' => $data];
    if ($strMsg !== null) {
        $arrReturn['message'] = $strMsg;
    }
    return $arrReturn;
}
