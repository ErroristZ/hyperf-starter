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

class ServerlogLogSearchable extends ServerlogLog
{
    use Searchable;

    /**
     * Get the index name for the model.
     */
    public function searchableAs(): string
    {
        return 'serverlog_log_index';
    }

    /**
     * Get the index able data array for the model.
     */
    public function toSearchableArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'user_name' => $this->user_name,
            'content' => $this->content,
            'url' => $this->url,
            'ip' => $this->ip,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
