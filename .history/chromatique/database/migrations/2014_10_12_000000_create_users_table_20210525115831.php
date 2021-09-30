<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('user\'s name');;
            $table->string('email')->unique()->comment('user\'s mail');;
            $table->timestamp('email_verified_at')->nullable()->comment('user\'s verification mail at');;
            $table->string('password')->comment('user\'s pass');;
            $table->boolean('isUploader')->comment('user is an uploader ?');;
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
