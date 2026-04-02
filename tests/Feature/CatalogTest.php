<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = Category::create([
            'name' => 'Троянди',
            'slug' => 'troyandi',
        ]);
    }

    public function test_catalog_page_loads(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_catalog_shows_active_products(): void
    {
        Product::create([
            'category_id' => $this->category->id,
            'name'        => 'Троянда червона',
            'price'       => 45.00,
            'stock'       => 10,
            'discount'    => 0,
            'is_active'   => true,
        ]);

        $response = $this->get('/');
        $response->assertSee('Троянда червона');
    }

    public function test_catalog_hides_inactive_products(): void
    {
        Product::create([
            'category_id' => $this->category->id,
            'name'        => 'Прихований товар',
            'price'       => 45.00,
            'stock'       => 10,
            'discount'    => 0,
            'is_active'   => false,
        ]);

        $response = $this->get('/');
        $response->assertDontSee('Прихований товар');
    }

    public function test_catalog_filter_by_category(): void
    {
        $other = Category::create(['name' => 'Букети', 'slug' => 'bukety']);

        Product::create([
            'category_id' => $this->category->id,
            'name'        => 'Троянда біла',
            'price'       => 45.00,
            'stock'       => 10,
            'discount'    => 0,
        ]);

        Product::create([
            'category_id' => $other->id,
            'name'        => 'Букет Ніжність',
            'price'       => 750.00,
            'stock'       => 5,
            'discount'    => 0,
        ]);

        $response = $this->get('/?category=troyandi');
        $response->assertSee('Троянда біла');
        $response->assertDontSee('Букет Ніжність');
    }

    public function test_catalog_search_by_name(): void
    {
        Product::create([
            'category_id' => $this->category->id,
            'name'        => 'Троянда червона',
            'price'       => 45.00,
            'stock'       => 10,
            'discount'    => 0,
        ]);

        Product::create([
            'category_id' => $this->category->id,
            'name'        => 'Тюльпан жовтий',
            'price'       => 25.00,
            'stock'       => 20,
            'discount'    => 0,
        ]);

        $response = $this->get('/?search=Троянда');
        $response->assertSee('Троянда червона');
        $response->assertDontSee('Тюльпан жовтий');
    }

    public function test_product_page_loads(): void
    {
        $product = Product::create([
            'category_id' => $this->category->id,
            'name'        => 'Тестова троянда',
            'price'       => 45.00,
            'stock'       => 10,
            'discount'    => 0,
        ]);

        $response = $this->get("/product/{$product->id}");
        $response->assertStatus(200);
        $response->assertSee('Тестова троянда');
    }

    public function test_sales_page_shows_discounted_products(): void
    {
        Product::create([
            'category_id' => $this->category->id,
            'name'        => 'Акційна троянда',
            'price'       => 100.00,
            'stock'       => 10,
            'discount'    => 20,
        ]);

        Product::create([
            'category_id' => $this->category->id,
            'name'        => 'Звичайна троянда',
            'price'       => 45.00,
            'stock'       => 10,
            'discount'    => 0,
        ]);

        $response = $this->get('/sales');
        $response->assertSee('Акційна троянда');
        $response->assertDontSee('Звичайна троянда');
    }
}
