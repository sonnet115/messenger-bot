<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('page_id');
            $table->date('prev_billing_date')->nullable();
            $table->date('next_billing_date')->nullable();
            $table->double('paid_amount')->nullable();
            $table->double('payable_amount')->nullable();
            $table->boolean('trial_status')->nullable();
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
        Schema::dropIfExists('billing_infos');
    }
}
