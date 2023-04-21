<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('assets_id')->constrained('assets')->cascadeOnDelete();
            $table->foreignId('depart_id')->constrained('departments')->cascadeOnDelete();
            $table->string('condtn_i');
            $table->string('condtn');
            $table->text('reason')->nullable();
            $table->string('status_i');
            $table->string('status')->default(0);
            $table->timestamp('assigned');
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
        Schema::dropIfExists('infos');
    }
}
