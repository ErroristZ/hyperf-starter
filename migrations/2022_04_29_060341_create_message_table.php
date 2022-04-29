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

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('message', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', '50');
            $table->string('content', '255')->nullable();
            $table->tinyInteger('type')->default(0)->comment('类型 1消息 2通知 3代办');
            $table->integer('user_id')->comment('用户ID');
            $table->tinyInteger('isRead')->default(0)->comment('类型 0未读 1已读 -1已删除');

            $table->unique('id');

            $table->timestamps();
            $table->softDeletes();
            $table->comment('消息表');
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
        Schema::dropIfExists('message');
    }
}
