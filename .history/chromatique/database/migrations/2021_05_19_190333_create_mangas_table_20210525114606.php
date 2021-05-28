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
                $table->string('manga_name')->nullable()->comment('le nom manga');
                $table->string('uploader')->nullable()->comment('l\'uploader du manga');

                $table->string('manga_jacket');
                $table->string('manga_banner');
                $table->string('manga_directory');
                $table->integer('manga_home_order');
                $table->timestamps();
                $table->unsignedBigInteger("user_id")->nullable();
                $table->foreign("user_id")->nullable()
                    ->references("id")
                    ->on("users")
                    ->onDelete("cascade")
                    ->onUpdate('cascade');
                $table->unsignedBigInteger("chapter_id")->nullable();
                $table->foreign("chapter_id")->nullable()
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
