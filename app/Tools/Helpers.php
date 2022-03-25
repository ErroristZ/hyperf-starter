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
