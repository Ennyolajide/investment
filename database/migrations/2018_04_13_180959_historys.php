<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class Historys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historys', function (Blueprint $table) {
        $table->increments('id');
        $table->bigInteger('tran_id')->unique();
        $table->dateTime('invest_date');
        $table->bigInteger('invest_amount');
        $table->Integer('tenure');
        $table->dateTime('return_date')->nullable();
        $table->dateTime('paid_date')->nullable();
        $table->bigInteger('return_amount');
        //$table->string('paid')->default('0');
        $table->string('proof')->nullable();
        $table->string('approved_date')->nullable();
        $table->string('status')->default('pending');
        $table->bigInteger('user_id');
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
        Schema::dropIfExists('historys');
    }
}
