<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->bigint('owner_id');
            $table->string('name');
            $table->text('information');
            $table->string('filename');
            $table->string('active');
            $table->timestamps();
            $table->int('category_id');
            $table->int('area_id');
            $table->string('local');
            $table->boolean('on_off');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
