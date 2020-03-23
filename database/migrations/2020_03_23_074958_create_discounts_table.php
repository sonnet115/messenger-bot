<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dicounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('from');
            $table->date('to');
            $table->bigInteger('pid');
            $table->string('dis_percentage');
            $table->string('max_customers');
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
        Schema::dropIfExists('dicounts');
    }
}
