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

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content', 500)->comment('评论内容');
            $table->bigInteger('parent_comment_id')->nullable()->comment('父评论ID');
            $table->integer('article_id')->comment('文章ID');
            $table->integer('user_id')->comment('作者ID');
            $table->tinyInteger('status')->default(0)->comment('状态 0待审核 1通过 -1失败');

            $table->index(['created_at']);

            $table->timestamps();
            $table->softDeletes();
            $table->comment('文章评论表');
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
        Schema::dropIfExists('comment');
    }
}
