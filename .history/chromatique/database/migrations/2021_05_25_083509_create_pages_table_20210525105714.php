<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_file')->comment('url de page');;
            $table->integer('page_number')->comment('numero de page');
            $table->timestamps();
            $table->unsignedBigInteger("chapter_id")->nullable();
            $table->foreign("chapter_id")->nullable()
                ->references("id")
                ->on("chapters")
                ->onDelete("cascade")
                ->onUpdate('cascade');
            $table->unsignedBigInteger("tome_id")->nullable();
            $table->foreign("tome_id")->nullable()
                ->references("id")
                ->on("tomes")
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
        Schema::dropIfExists('pages');
    }
}
