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

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("Server success")
     */
    public const SUCCESS = 200;

    /**
     * @Message("Server fail")
     */
    public const HTTP_ERROR = 400;

    /**
     * @Message("Server Error")
     */
    public const SERVER_ERROR = 500;

    /**
     * @Message("系统参数错误")
     */
    public const SYSTEM_INVALID = 700;

    /**
     * @Message("检查文件是否存在")
     */
    public const FILE_ERROR = 10001;

    /**
     * @Message("参数非法")
     */
    public const PARAMS_INVALID = 1000;

    public const MESSAGES = [
        self::SUCCESS => 'success',
        self::HTTP_ERROR => 'fail',
        self::SERVER_ERROR => 'Server Error',
        self::SYSTEM_INVALID => '系统参数错误',
        self::PARAMS_INVALID => '参数非法',
        self::FILE_ERROR => '检查文件是否存在',
    ];
}
