<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tomes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('tomes_number')->comment('tome\'s name');
                $table->string('tomes_path')->comment('tome\'s path');
                $table->timestamps();
                $table->unsignedBigInteger("manga_id")->nullable();
                $table->foreign("manga_id")->nullable()
                    ->references("id")
                    ->on("mangas")
                    ->onDelete("cascade")
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tomes');
    }
}