<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMangasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mangas', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('manga_name')->comment('manga\'s name');
                $table->string('manga_cover')->comment('manga\'s cover path');
                $table->string('manga_banner')->comment('manga\'s banner path')->nullable();
                $table->string('manga_directory')->comment('manga\'s directory path');
                $table->integer('manga_home_order')->comment('manga\'s home order')->default(0);
                $table->timestamps();
                $table->unsignedBigInteger("uploader_id")->nullable();
                $table->foreign("uploader_id")->nullable()
                    ->references("id")
                    ->on("users")
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
        Schema::dropIfExists('mangas');
    }
}
