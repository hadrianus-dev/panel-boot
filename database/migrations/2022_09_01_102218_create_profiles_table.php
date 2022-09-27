<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->boolean('normal')->default(false);
            $table->boolean('member')->default(false);
            $table->boolean('leader')->default(false);
            $table->boolean('manager')->default(false);
            $table->boolean('cummercial')->default(false);
            $table->foreignId('user_id')->index()->constrained()->OnDelete('CASCADE');
            $table->boolean('published')->default(true);
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
        Schema::dropIfExists('profiles');
    }
}
