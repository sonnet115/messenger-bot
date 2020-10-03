<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('page_name', 50);
            $table->string('page_id', 100);
            $table->text('page_access_token');
            $table->string('page_owner_id', 100);
            $table->boolean('page_connected_status');
            $table->boolean('page_subscription_status')->default(0);
            $table->string('page_contact', 15)->nullable();
            $table->bigInteger('page_likes')->nullable();
            $table->boolean('is_published')->nullable();
            $table->boolean('is_webhooks_subscribed')->nullable();
            $table->string('page_username', 100)->nullable();
            $table->string('page_address', 100)->nullable();
            $table->text('page_web_link')->nullable();
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
        Schema::dropIfExists('shops');
    }
}
