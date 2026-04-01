<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Троянди',     'slug' => 'troyandi'],
            ['name' => 'Букети',      'slug' => 'bukety'],
            ['name' => 'Тюльпани',    'slug' => 'tyulpany'],
            ['name' => 'Орхідеї',     'slug' => 'orchideyi'],
            ['name' => 'Хризантеми',  'slug' => 'hryzantemy'],
            ['name' => 'Сухоцвіти',   'slug' => 'sukhocvity'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}