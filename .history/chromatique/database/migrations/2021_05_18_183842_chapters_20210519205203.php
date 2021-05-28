<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Chapters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('chapter_name')->nullable()->comment('le nom du chapitre');
            $table->string('chapter_number');
            $table->timestamps();
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
        //
    }
}
