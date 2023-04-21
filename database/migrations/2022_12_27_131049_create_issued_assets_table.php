<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuedAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issued_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('assets_id')->constrained('assets')->cascadeOnDelete();
            $table->foreignId('depart_id')->constrained('departments')->cascadeOnDelete();
            $table->string('status')->default(0);
            $table->enum('condtn',['new','used','repaired','broken'])->default('new');
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
        Schema::dropIfExists('issued_assets');
    }
}
