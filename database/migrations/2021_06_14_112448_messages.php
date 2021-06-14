<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Messages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("messages", function (Blueprint $table) {
            $table->id("id");
            $table->unsignedBigInteger("from_id");
            $table->unsignedBigInteger("to_id");
            $table->text("content");
            $table->timestamps();
            $table->foreign("from_id")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("to_id")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("messages");
    }
}