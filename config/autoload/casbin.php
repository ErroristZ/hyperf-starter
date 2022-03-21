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
return [
    /*
     * Casbin model setting.
     */
    'model' => [
        // Available Settings: "file", "text"
        'config_type' => 'file',
        'config_file_path' => BASE_PATH . '/config/autoload/casbin-rbac-model.conf',
        'config_text' => '',
    ],
    /*
     * Casbin adapter .
     */
    'adapter' => [
        'class' => \Donjan\Casbin\Adapters\Mysql\DatabaseAdapter::class,
        'constructor' => [
            'tableName' => 'casbin_rule',
        ],
    ],
    'log' => [
        'enabled' => false,
    ],
];
