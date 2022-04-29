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
namespace App\Service\Admin;

use App\Controller\AbstractController;
use App\Model\Message;

class MessageService extends AbstractController
{
    /**
     * FunctionName：list
     * Description：
     * Author：zhangkang.
     */
    public function list(): array
    {
        return $this->buildSuccess(Message::query()->orderBy('id')->get()->toArray());
    }

    /**
     * FunctionName：add
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function add($request): array
    {
        $arrSet = [
            'type' => $request->input('type') ?? 1,
            'title' => $request->input('title'),
            'content' => $request->input('content') ?? '',
            'user_id' => $request->input('user_id') ?? '',
            'isRead' => 1,
        ];

        Message::insert($arrSet);

        return $this->buildSuccess();
    }
}
