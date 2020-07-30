<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 30);
            $table->bigInteger('customer_id');
            $table->string('customer_name', 50);
            $table->string('billing_address', 100);
            $table->string('shipping_address', 100);
            $table->string('contact', 15);
            $table->string('additional_order_details', 255)->nullable();
            $table->tinyInteger('order_status')->default(0);
            $table->integer('status_updated_by')->nullable();
            $table->smallInteger('shop_id');
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
        Schema::dropIfExists('orders');
    }
}
