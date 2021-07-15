<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTomesForeignkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::table('tomes', function (Blueprint $table) {
            $table->unsignedBigInteger("manga_id");
            $table->foreign("manga_id")
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
        Schema::disableForeignKeyConstraints();
        Schema::table('tomes', function (Blueprint $table) {
            $table->dropForeign('tomes_manga_id_foreign');
            $table->dropColumn('manga_id');
    });
    }
}