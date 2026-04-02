<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_has_discounted_price_attribute(): void
    {
        $product = new Product([
            'price' => 100.00,
            'discount' => 20,
        ]);

        $this->assertEquals(80.00, $product->discounted_price);
    }

    public function test_product_without_discount_returns_original_price(): void
    {
        $product = new Product([
            'price' => 100.00,
            'discount' => 0,
        ]);

        $this->assertEquals(100.00, $product->discounted_price);
    }

    public function test_product_is_active_by_default(): void
    {
        $category = Category::create(['name' => 'Троянди', 'slug' => 'troyandi']);

        $product = Product::create([
            'category_id' => $category->id,
            'name'        => 'Тестова троянда',
            'price'       => 45.00,
            'stock'       => 10,
            'discount'    => 0,
        ]);

        $this->assertTrue($product->is_active);
    }

    public function test_product_out_of_stock(): void
    {
        $product = new Product(['stock' => 0]);
        $this->assertEquals(0, $product->stock);
    }

    public function test_product_belongs_to_category(): void
    {
        $category = Category::create(['name' => 'Букети', 'slug' => 'bukety']);

        $product = Product::create([
            'category_id' => $category->id,
            'name'        => 'Букет Ніжність',
            'price'       => 750.00,
            'stock'       => 30,
            'discount'    => 0,
        ]);

        $this->assertInstanceOf(Category::class, $product->category);
        $this->assertEquals('Букети', $product->category->name);
    }
}