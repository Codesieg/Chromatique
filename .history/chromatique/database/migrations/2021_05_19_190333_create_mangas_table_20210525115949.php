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
                $table->string('uploader')->nullable()->comment('manga\'s uploader name');
                $table->string('manga_cover')->comment('manga\'s cover path');
                $table->string('manga_banner')->comment('manga\'s banner path');
                $table->string('manga_directory')->comment('manga\'s directory path');
                $table->integer('manga_home_order')->comment('manga\'s home order');
                $table->timestamps();
                $table->unsignedBigInteger("uploader_id")->nullable();
                $table->foreign("uploader_id")->nullable()
                    ->references("id")
                    ->on("users")
                    ->onDelete("cascade")
                    ->onUpdate('cascade');
                $table->unsignedBigInteger("chapter_id");
                $table->foreign("chapter_id")
                    ->references("id")
                    ->on("chapters")
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
