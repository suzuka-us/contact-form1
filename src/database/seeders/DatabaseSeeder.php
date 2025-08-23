<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::create(['name' => '商品のお届けについて']);
        Category::create(['name' => '商品の交換について']);
        Category::create(['name' => '商品トラブル']);
        Category::create(['name' => 'ショップへのお問い合わせ']);
        Category::create(['name' => 'その他']);
        
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
