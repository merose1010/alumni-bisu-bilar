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
        Schema::create('alumni_mem', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('bday')->nullable();
            $table->string('con_num')->nullable();
            $table->string('fb')->nullable();
            $table->string('user_id')->nullable();
            $table->string('pay_med')->nullable();
            $table->string('status')->nullable();
            $table->string('signature')->nullable();
            $table->string('price')->nullable();
            $table->string('reference_no')->nullable();
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
        Schema::dropIfExists('alumni_mem');
    }
};
