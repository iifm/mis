<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('user_id')->unsigned();
            $table->integer('department')->unsigned();
            $table->string('subject');
            $table->text('description');
            $table->string('sip');
            $table->timestamps();
        });

          Schema::table('requirements', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

            Schema::table('requirements', function($table) {
            $table->foreign('department')->references('id')->on('departments');
        });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requirements');
    }
}
