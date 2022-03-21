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
namespace App\Controller;

use App\Model\ArticleSearchable;

class IndexController extends AbstractController
{
    public function index(): array
    {
        $list = ArticleSearchable::search('tag')->get();

        $user = $this->request->input('user', 'Hyperf');

        return [
            'list' => $list,
            'message' => "Hello {$user}.",
        ];
    }
}
