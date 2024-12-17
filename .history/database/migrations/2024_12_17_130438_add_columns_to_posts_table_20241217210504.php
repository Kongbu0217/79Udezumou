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
        Schema::table('posts', function (Blueprint $table) {
            Schema::table('posts', function (Blueprint $table) {
                $table->string('prio'); // 優先順位（必須）
                $table->string('moto')->nullable(); // モチベーション（任意）
                $table->string('category')->nullable(); // 分類（任意）
                $table->timestamp('cob')->nullable(); // 締切日（任意）
                $table->string('path')->nullable(); // 画像（任意）
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
};
