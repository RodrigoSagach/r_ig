<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('excerpt_id')->unsigned()->nullable();
            $table->integer('account_type')->unsigned()->default(0);
            $table->string('account_value')->nullable();
            $table->double('amount')->default(0.0);
            $table->string('description')->nullable();
            $table->integer('status')->unsigned()->default(0);
            $table->string('response')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('excerpt_id')->references('id')->on('excerpts')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('withdrawal_requests');
    }
}
