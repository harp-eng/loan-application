<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 11, 2);
            $table->tinyInteger('loan_term')->comment('weeks');
            $table->decimal('interest_rate', 3, 2)->comment('weekly');
            $table->tinyInteger('status')->default(0)->comment('0=>pending,1=>approved,2=>rejected,3=full_paid');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('loans');
    }
}
