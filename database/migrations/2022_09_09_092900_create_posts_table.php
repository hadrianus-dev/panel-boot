<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('title')->unique();
            $table->string('slug')->unique();

            $table->mediumText('body')->nullable();
            $table->text('description')->nullable();

            $table->boolean('published')->default(false);
            $table->text('cover')->nullable();
            $table->decimal('views')->nullable();
            
            $table->foreignId('category_id')->index()->constrained()->OnDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
