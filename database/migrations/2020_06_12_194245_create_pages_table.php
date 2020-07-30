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
            $table->string('page_name', '50');
            $table->string('page_contact', '15');
            $table->string('page_address', '100');
            $table->text('page_web_link');
            $table->string('page_unique_id', 50);
            $table->text('page_token');
            $table->string('app_id', 100);
            $table->string('owner_name', '30');
            $table->string('owner_contact', '15');
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
