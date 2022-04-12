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

use Carbon\Carbon;
use Hyperf\Database\Model\SoftDeletes;
use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $mobile
 * @property string $password
 * @property string $nickname
 * @property string $username
 * @property string $email
 * @property string $avatar
 * @property int $status
 * @property string $position
 * @property string $ip
 * @property Carbon $last_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 */
class User extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *`.
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'password', 'mobile', 'nickname', 'username', 'status', 'avatar', 'email', 'position', 'created_at', 'ip', 'last_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime', 'status' => 'integer'];

    protected $hidden = ['password'];
}
