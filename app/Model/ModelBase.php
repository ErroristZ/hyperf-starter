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

use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\Database\Model\Builder;
use Hyperf\Utils\HigherOrderTapProxy;

class ModelBase extends Model implements ModelInterface
{
    /**
     * 根据主键获取一个实体.
     * @param $id *主键
     * @return Builder|\Hyperf\Database\Model\Model|object
     */
    public static function getFirstById($id)
    {
        return self::query()->where('id', $id)->first();
    }

    /**
     * 根据条件获取一个实体.
     * @param array $where *条件数组
     * @param array $select *显示字段
     * @return Builder|\Hyperf\Database\Model\Model|object
     */
    public static function getFirstByWhere(array $where, $select = ['*'])
    {
        return self::query()->where($where)->first($select);
    }

    /**
     * 获取实体的所有数据.
     * @param array $where *条件数组
     * @param array $select *显示字段
     * @param bool $needToArray *是否序列化成数组
     */
    public static function getAllData(array $where, array $select = ['*'], bool $needToArray = false): array
    {
        $query = self::query()->where($where)->select($select);

        if ($needToArray) {
            return $query->get()->toArray();
        }

        return $query->get();
    }

    /**
     * 获取模型分页数据 ?page=1&pageSize=10.
     * @param array $where *条件数组
     * @param int $pageSize *页数
     * @param array $select *显示字段
     * @param string $order *排序字段
     * @param string $sort *排序方式
     */
    public static function getList(array $where = [], int $pageSize = 20, array $select = ['*'], string $order = 'id', string $sort = 'DESC'): LengthAwarePaginatorInterface
    {
        return self::query()->where($where)->select($select)->orderBy($order, $sort)->paginate($pageSize);
    }

    /**
     * FunctionName：getConfigValueByKey
     * Description：
     * Author：zhangkang.
     * @param $configKey
     * @return HigherOrderTapProxy|mixed|string|void
     */
    public static function getConfigValueByKey($configKey, string $default = '')
    {
        $configValue = self::query()->where([
            'key' => $configKey,
        ])->value('value');

        if (is_null($configValue)) {
            return $default;
        }

        return $configValue;
    }
}
