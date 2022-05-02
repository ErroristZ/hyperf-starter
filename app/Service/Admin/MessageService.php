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
use App\Model\MessageUser;
use Hyperf\DbConnection\Db;
use Phper666\JWTAuth\Util\JWTUtil;

class MessageService extends AbstractController
{
    /**
     * FunctionName：list
     * Description：
     * Author：zhangkang.
     * @param mixed $request
     */
    public function list($request): array
    {
        $page = (int) $request->input('page', 1);
        $limit = (int) $request->input('limit', 10);

        $list = Message::query();

        if ($request->input('title')) {
            $list->where('title', 'like', "%{$request->input('title')}%");
        }

        if ($request->input('type')) {
            $list->where('type', $request->input('type'));
        }

        if ($request->input('created_at')) {
            $list->whereBetween('created_at', $request->input('created_at'));
        }

        $list = $list->orderByDesc('id')->paginate($limit, ['*'], 'page', $page);

        foreach ($list->items() as $key => $value) {
            $list->items()[$key]['messageUserId'] = array_column(MessageUser::query()->where('message_id', $value['id'])->get(['user_id'])->toArray(), 'user_id');
        }

        return $this->paginate($list);
    }

    /**
     * FunctionName：add
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function add($request): array
    {
        Db::transaction(function ($request) {
            $mid = Message::insert([
                'type' => $request->input('type') ?? 1,
                'title' => $request->input('title'),
                'content' => $request->input('content') ?? '',
                'user_id' => JWTUtil::getParserData($request)['uid'],
                'isRead' => 1,
            ]);

            $data = [];
            foreach ($request->input('Ids') as $v) {
                $data[] = [
                    'message_id' => $mid,
                    'user_id' => $v,
                ];
            }
            MessageUser::insert($data);
        });

        return $this->buildSuccess();
    }
}
