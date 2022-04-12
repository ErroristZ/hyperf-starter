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

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $parent_id
 * @property int $is_display
 * @property int $menuType
 * @property string $route
 * @property string $path
 * @property string $method
 * @property string $name
 * @property string $description
 * @property int $sort
 * @property string $icon
 */
class Permission extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'route', 'is_display', 'menuType', 'path', 'method', 'name', 'description', 'sort', 'icon'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'int', 'parent_id' => 'integer', 'is_display' => 'integer', 'menuType' => 'integer', 'sort' => 'integer'];
}
