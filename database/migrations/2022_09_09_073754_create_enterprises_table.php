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
        Schema::create('enterprises', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('title')->unique();
            $table->string('slug')->unique();

            $table->mediumText('body')->nullable();
            $table->text('description')->nullable();
            $table->text('founder')->nullable();
            $table->text('logo')->nullable();
            $table->text('cover')->nullable();

            $table->boolean('published')->default(false);

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
        Schema::dropIfExists('enterprises');
    }
};
