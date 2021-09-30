<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
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
            $table->intger('chapter_number')->comment('chapter\'s number');
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
        Schema::dropIfExists('chapters');   
    }
}
