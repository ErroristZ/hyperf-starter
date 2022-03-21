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

use Hyperf\Scout\Searchable;

class LogSearchable extends Log
{
    use Searchable;

    /**
     * Get the index name for the model.
     */
    public function searchableAs(): string
    {
        return 'log_index';
    }

    /**
     * Get the index able data array for the model.
     */
    public function toSearchableArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'action' => $this->action,
            'url' => $this->url,
            'info' => $this->info,
            'ip' => $this->ip,
        ];
    }
}
