<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegates', function (Blueprint $table) {
            $table->id();
            $table->string("p_lastname");
            $table->string("m_lastname");
            $table->string("names");
            $table->string("ci")->unique();
            $table->date("d_birth");
            $table->string("user_id", 36);
            $table->unsignedBigInteger("university_id");
            $table->foreign('university_id')->references('id')->on('universities');
            $table->unsignedBigInteger("commission_id");
            $table->foreign('commission_id')->references('id')->on('commissions');
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
        Schema::dropIfExists('delegates');
    }
}
