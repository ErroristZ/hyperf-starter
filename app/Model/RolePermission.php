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
 * @property int $roleId
 * @property int $menuId
 * @property int $pseudoChecked
 */
class RolePermission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['roleId', 'menuId', 'pseudoChecked'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['roleId' => 'integer', 'menuId' => 'integer', 'pseudoChecked' => 'integer'];
}
