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

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100)->comment('文章标题');
            $table->text('content')->comment('文章内容');
            $table->json('images')->nullable()->comment('文章封面图片');
            $table->string('tag')->nullable()->comment('标签');
            $table->tinyInteger('status')->default(0)->comment('状态 0待审核 1通过 -1失败');
            $table->tinyInteger('is_display')->default(1)->comment('是否显示 1显示 -1隐藏');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('id');
            $table->index('title');

            $table->comment('文章表');
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
        Schema::dropIfExists('article');
    }
}
