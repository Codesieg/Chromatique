<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPagesForeignkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->unsignedBigInteger("chapter_id");
            $table->foreign("chapter_id")
                ->references("id")
                ->on("chapters")
                ->onDelete("cascade")
                ->onUpdate('cascade');
            $table->unsignedBigInteger("tome_id");
            $table->foreign("tome_id")
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
        //
    }
}
