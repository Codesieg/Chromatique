<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoredByMangasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mangas', function (Blueprint $table) {
            $table->unsignedBigInteger("coloredBy_id")->nullable();
            $table->foreign("coloredBy_id")->nullable()
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
        Schema::disableForeignKeyConstraints();
        Schema::table('mangas', function (Blueprint $table) {
            $table->dropForeign('mangas_coloredBy_id_foreign');
            $table->dropColumn('coloredBy_id');    });
    }
}
