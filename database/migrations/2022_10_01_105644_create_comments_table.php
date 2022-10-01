<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name', 255);
            $table->string('email');

            $table->text('body')->nullable();

            $table->boolean('published')->default(true);
            
            $table->foreignId('post_id')->index()->constrained()->OnDelete('CASCADE')->nullable();
            $table->foreignId('portfolio_id')->index()->constrained()->OnDelete('CASCADE')->nullable();
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
        Schema::dropIfExists('comments');
    }
}
