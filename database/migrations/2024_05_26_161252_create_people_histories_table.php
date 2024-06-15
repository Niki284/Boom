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
        Schema::create('people_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('people_id');
            $table->string('school')->nullable();
            $table->string('university')->nullable();
            $table->string('work')->nullable();
            $table->string('married')->nullable();
            $table->string('divorce')->nullable();

            
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
        Schema::dropIfExists('people_histories');
    }
};
