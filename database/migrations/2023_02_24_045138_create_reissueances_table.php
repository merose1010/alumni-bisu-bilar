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
        Schema::create('reissueances', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('id_no')->nullable();
            $table->string('degree')->nullable();
            $table->string('reason')->nullable();
            $table->string('or_no')->nullable();
            $table->string('user_id')->nullable();
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('reissueances');
    }
};
