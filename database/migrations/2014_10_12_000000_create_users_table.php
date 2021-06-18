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
            $table->string('login');
            $table->string('password');
            $table->string('name');
            $table->string('family');
            $table->date("birth");
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('phone');
            $table->text("information")->nullable();
            $table->boolean("eat")->default(false);
            $table->timestamp("loginDate")->default(NOW());
            $table->string("locationId")->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign("id")->references("toId")->on("dialogs");
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
