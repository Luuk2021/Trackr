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

            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('pairing_code');

            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('streetname');
            $table->string('housenumber');
            $table->string('zipcode');
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
