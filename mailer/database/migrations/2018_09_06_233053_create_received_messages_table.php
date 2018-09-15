<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivedMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_messages', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('subject', 100);
            $table->string('to_email', 42);
            $table->string('message', 2000);
            $table->string('from_user_id', 32)->references('id')->on('users')->onUpdate('cascade')->onDelete(NULL);
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
        //
    }
}
