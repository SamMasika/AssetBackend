<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assets_id')->constrained('assets')->cascadeOnDelete();
            $table->enum('transport_type',['vehicle','bajaj'])->nullable();
            $table->string('cheses_no')->nullable();
            $table->string('reg_no');
            $table->string('engine_capacity')->nullable();
            $table->string('brand');
            $table->string('model');
            $table->boolean('flug')->default(1);
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
        Schema::dropIfExists('transports');
    }
}
