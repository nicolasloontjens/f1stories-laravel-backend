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
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->date("date");
            $table->timestamps();
        });

        Schema::create('races_language',function(Blueprint $table){
            $table->id();
            $table->integer('race_id');
            $table->string('language');
            $table->string('title');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('races_language');
        Schema::dropIfExists('races');
    }
};
