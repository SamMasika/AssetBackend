<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnavailablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unavailables', function (Blueprint $table) {
            $table->id();
            $table->string('asset_name');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('depart_id')->constrained('departments')->cascadeOnDelete();
            $table->enum('category',['electronic','furniture','building','transport',])->nullable();
            $table->enum('status',['0','1','2','3'])->default('0');
            $table->text('remark')->nullable();
            $table->text('specification');
            $table->boolean('flug')->default(0);
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
        Schema::dropIfExists('unavailables');
    }
}
