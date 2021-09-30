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
            Schema::create('tomes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('tomes')->nullable();
                $table->string('tomes_number')->nullable();
                $table->string('tomes_path')->nullable();
                $table->timestamps();
                $table->unsignedBigInteger("manga_id")->nullable();
                $table->foreign("manga_id")->nullable()
                    ->references("id")
                    ->on("mangas")
                    ->onDelete("cascade")
                    ->onUpdate('cascade');
            });
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
