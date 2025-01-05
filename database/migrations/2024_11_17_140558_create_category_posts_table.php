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
        Schema::create('category_posts', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('posts')->cascadeOnDelete(); // 外部キー: posts.id
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete(); // 外部キー: categories.id
            $table->primary(['post_id', 'category_id']); // 複合主キー
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_posts');
    }
};
