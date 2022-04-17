<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('body');
            $table->morphs("commentable");
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('comments');
    }
    // $table->integer('commentable_id');
    // $table->string('commentable_type');
};
