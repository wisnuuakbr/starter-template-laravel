<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('parent_id', 10)->nullable();
            $table->string('name', 50);
            $table->string('url', 100);
            $table->string('icon', 50)->nullable();
            $table->string('description', 100)->nullable();
            $table->unsignedInteger('sort')->nullable()->default(0);
            $table->enum('display_st', ['1', '0'])->nullable()->default('1');
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
        Schema::dropIfExists('navigations');
    }
}
