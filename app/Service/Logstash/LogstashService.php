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
namespace App\Service\Logstash;

use Monolog\Formatter\LogstashFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LogstashService
{
    public function __invoke(array $config): LoggerInterface
    {
        $handler = new RotatingFileHandler(
            config('logstash.logstash_log_path'),
            config('logstash.logstash_days') ?? 14,
            Logger::DEBUG,
            true,
            config('logstash.log_file_permission', null)
        );
        $appName = config('app.name');
        $handler->setFormatter(new LogstashFormatter($appName));
        return new Logger($appName, [$handler]);
    }
}
