<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('full_name');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->text('responsability')->nullable();
            $table->text('description')->nullable();

            $table->boolean('published')->default(false);
            $table->text('cover')->nullable();
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
        Schema::dropIfExists('teams');
    }
}
