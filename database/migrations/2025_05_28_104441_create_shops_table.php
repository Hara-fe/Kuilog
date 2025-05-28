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
                $table->unsignedBigInteger('owner_id');
                $table->string('name');
                $table->text('information');
                $table->string('filename');
                $table->string('active');
                $table->timestamps();
                $table->unsignedBigInteger('category_id');
                $table->unsignedBigInteger('area_id');
                $table->string('local');
                $table->boolean('on_off');

                // 外部キー設定
                $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
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
