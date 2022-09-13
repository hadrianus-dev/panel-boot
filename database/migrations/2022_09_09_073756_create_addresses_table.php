<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('state_id');
            $table->string('city_id');
            $table->string('district')->nullable();
            $table->string('home')->nullable();

            $table->boolean('published')->default(false);

            $table->foreignId('user_id')->index()->constrained()->OnDelete('CASCADE')->nullable();
            $table->foreignId('enterprise_id')->index()->constrained()->OnDelete('CASCADE')->nullable();
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
        Schema::dropIfExists('addresses');
    }
};
