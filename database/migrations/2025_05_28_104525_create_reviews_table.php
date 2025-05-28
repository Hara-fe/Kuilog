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
      Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');  // ✅ 型修正
            $table->unsignedBigInteger('user_id');  // ✅ reviewer_name を置き換え
            $table->double('review');
            $table->text('comment');
            $table->timestamps(); // ✅ created_at の代わりにこれでOK

            // 外部キー設定
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
