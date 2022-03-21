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
use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->comment('姓名');
            $table->string('mobile', 12)->comment('联系电话');
            $table->string('password')->comment('密码');
            $table->string('nickname', 50)->comment('用户昵称');
            $table->string('username', 50)->nullable()->comment('账号');
            $table->string('email', 50)->comment('邮箱');
            $table->string('avatar', 500)->nullable()->comment('头像');
            $table->tinyInteger('status')->default(1)->comment('状态 0待审核 1通过 -1失败');
            $table->string('position', 255)->nullable()->comment('职位');

            $table->index('id');
            $table->index('name');
            $table->unique('username');

            $table->timestamps();
            $table->softDeletes();
            $table->comment('用户表');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
