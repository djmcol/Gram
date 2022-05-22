<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained('users');
            $table->foreignId('user_id')->constrained('users');
            $table->string('message')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->date('send_date');
            $table->enum('type' , ['text' , 'image' , 'document'])->default('text')->nullable();

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
        Schema::dropIfExists('messajes');
    }
}
