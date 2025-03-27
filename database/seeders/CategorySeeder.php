<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\categories;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => '技術', 'slug' => 'technology'],
            ['name' => 'プログラミング', 'slug' => 'programming'],
            ['name' => 'Web開発', 'slug' => 'web-development'],
            ['name' => 'AI/機械学習', 'slug' => 'ai-machine-learning'],
            ['name' => 'データベース', 'slug' => 'database'],
            ['name' => 'セキュリティ', 'slug' => 'security'],
            ['name' => 'その他', 'slug' => 'others'],
        ];

        foreach ($categories as $category) {
            categories::create($category);
        }
    }
} 