<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('group_id');
            $table->dateTime('expired_at')->nullable();
            $table->unique(['user_id', 'group_id']);
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('group_id')->references('id')->on('groups');            
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
        Schema::dropIfExists('users_groups');
    }
};
