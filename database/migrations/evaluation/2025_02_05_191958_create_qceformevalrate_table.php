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
        Schema::create('qceformevalrate', function (Blueprint $table) {
            $table->id();
            $table->integer('qceschlyearsemID')->nullable();
            $table->string('schlyear')->nullable();
            $table->string('semester')->nullable();
            $table->string('ratingfromto')->nullable();
            $table->integer('qcefacID')->nullable();
            $table->string('qcefacname')->nullable();
            $table->string('qceevaluator')->nullable();
            $table->string('question')->nullable();
            $table->string('question_rate')->nullable();
            $table->text('qcecomments')->nullable();
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
        Schema::dropIfExists('qceformevalrate');
    }
};
