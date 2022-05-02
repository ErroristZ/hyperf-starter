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
 * @property int $message_id
 * @property int $user_id
 * @property int $isRead
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 */
class MessageUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'message_id', 'user_id', 'isRead', 'created_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'int', 'message_id' => 'integer', 'user_id' => 'integer', 'isRead' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
