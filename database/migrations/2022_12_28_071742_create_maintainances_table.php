<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintainancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintainances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assets_id')->constrained('assets')->cascadeOnDelete();
            $table->string('condtn');
            $table->boolean('flug')->default(1);
            $table->timestamp('returned_at');
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
        Schema::dropIfExists('maintainances');
    }
}
