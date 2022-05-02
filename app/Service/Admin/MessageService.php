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

use App\Constants\CodeConstants;
use App\Controller\AbstractController;
use App\Model\Message;
use App\Model\MessageUser;
use Carbon\Carbon;
use Hyperf\DbConnection\Db;
use Phper666\JWTAuth\Util\JWTUtil;
use Throwable;

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
        Db::beginTransaction();
        try {
            $mid = Message::query()->create([
                'type' => $request->input('type') ?? 1,
                'title' => $request->input('title'),
                'content' => $request->input('content') ?? '',
                'user_id' => JWTUtil::getParserData($request)['uid'],
            ]);

            $data = [];
            foreach ($request->input('Ids') as $v) {
                $data[] = [
                    'message_id' => $mid->id,
                    'user_id' => $v,
                    'isRead' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            MessageUser::query()->insert($data);

            Db::commit();
        } catch (Throwable $ex) {
            Db::rollBack();
            return $this->buildFailed(CodeConstants::ADD_PARAMETER_ERROR);
        }
        return $this->buildSuccess();
    }

    /**
     * FunctionName：delete
     * Description：
     * Author：zhangkang.
     * @param $request
     */
    public function delete($request): array
    {
        Db::beginTransaction();
        try {
            Message::where('id', $request->input('id'))->delete();

            MessageUser::where('message_id', $request->input('id'))->delete();

            Db::commit();
        } catch (Throwable $ex) {
            Db::rollBack();
        }

        return $this->buildSuccess();
    }
}
