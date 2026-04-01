<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['category_id' => 1, 'name' => 'Троянда червона (1 шт)',       'price' => 45.00,   'stock' => 200],
            ['category_id' => 1, 'name' => 'Троянда біла (1 шт)',          'price' => 45.00,   'stock' => 150],
            ['category_id' => 1, 'name' => 'Троянда рожева (1 шт)',        'price' => 40.00,   'stock' => 120],
            ['category_id' => 2, 'name' => 'Букет «Ніжність» (15 троянд)', 'price' => 750.00,  'stock' => 30],
            ['category_id' => 2, 'name' => 'Букет «Пристрасть» (25 троянд)','price' => 1200.00,'stock' => 5],
            ['category_id' => 3, 'name' => 'Тюльпан червоний (1 шт)',      'price' => 25.00,   'stock' => 300],
            ['category_id' => 3, 'name' => 'Тюльпан жовтий (1 шт)',        'price' => 25.00,   'stock' => 280],
            ['category_id' => 4, 'name' => 'Орхідея Фаленопсис біла',      'price' => 450.00,  'stock' => 0],
            ['category_id' => 5, 'name' => 'Хризантема біла (1 шт)',       'price' => 35.00,   'stock' => 90],
            ['category_id' => 6, 'name' => 'Сухоцвіти «Прованс»',         'price' => 180.00,  'stock' => 25],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}