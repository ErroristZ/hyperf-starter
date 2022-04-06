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

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->comment('上级权限');
            $table->tinyInteger('is_display')->comment('上级权限');
            $table->string('path', '255');
            $table->string('method', '10');
            $table->string('name', '255');
            $table->string('url', '255')->comment('别名，配合前端连接');
            $table->text('validate')->comment('附加验证规则');
            $table->string('description', '255')->comment('附加验证规则');
            $table->unsignedMediumInteger('sort')->comment('排序');

            $table->unique(['path', 'method'], 'path');

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
        Schema::dropIfExists('permissions');
    }
}
