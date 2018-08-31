<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->integer('category')->unsigned();
            $table->string('description');
            $table->string('uploadfile');
            $table->string('addedby');
            $table->string('updatedby');
            $table->string('sip');
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
        Schema::dropIfExists('news_uploads');
    }
}
