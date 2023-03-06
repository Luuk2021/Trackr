<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            /** ENUM */
            $table->string('status');
            /** end ENUM */

            $table->foreignId('user_id')->constrained();
            $table->string('pairing_code');

            $table->string('email');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('streetname');
            $table->string('house_number');
            $table->string('zip_code');
            $table->string('city');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
