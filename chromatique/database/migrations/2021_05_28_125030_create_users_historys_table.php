<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersHistorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_historys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade")
                ->onUpdate('cascade');
            $table->unsignedBigInteger("manga_id");
            $table->foreign("manga_id")
                ->references("id")
                ->on("mangas")
                ->onDelete("cascade")
                ->onUpdate('cascade');
            $table->unsignedBigInteger("tome_id");
            $table->foreign("tome_id")
                ->references("id")
                ->on("tomes")
                ->onDelete("cascade")
                ->onUpdate('cascade');
            $table->unsignedBigInteger("chapter_id");
            $table->foreign("chapter_id")
                ->references("id")
                ->on("chapters")
                ->onDelete("cascade")
                ->onUpdate('cascade');
            $table->unsignedBigInteger("page_id");
            $table->foreign("page_id")
                ->references("id")
                ->on("page")
                ->onDelete("cascade")
                ->onUpdate('cascade');
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
        Schema::dropIfExists('users_historys');
    }
}
