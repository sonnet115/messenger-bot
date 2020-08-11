<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('email', 50)->unique()->nullable();
            $table->string('provider', 10)->unique()->nullable();
            $table->string('user_id', 100)->unique();
            $table->text('profile_picture')->nullable();
            $table->string('contact', 20)->nullable();
            $table->boolean('page_added')->default(0);
            $table->boolean('profile_completed')->default(0);
            $table->text('long_lived_user_token')->nullable();
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
        Schema::dropIfExists('users');
    }
}
