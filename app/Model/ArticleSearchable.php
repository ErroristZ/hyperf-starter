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

class ArticleSearchable extends Article
{
    use Searchable;

    /**
     * Get the index name for the model.
     */
    public function searchableAs(): string
    {
        return 'article_index';
    }

    /**
     * Get the index able data array for the model.
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'images' => $this->images,
            'tag' => $this->tag,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
