<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_status_label_pending(): void
    {
        $order = new Order(['status' => 'pending']);
        $this->assertEquals('Очікує', $order->status_label);
    }

    public function test_order_status_label_confirmed(): void
    {
        $order = new Order(['status' => 'confirmed']);
        $this->assertEquals('Підтверджено', $order->status_label);
    }

    public function test_order_status_label_delivering(): void
    {
        $order = new Order(['status' => 'delivering']);
        $this->assertEquals('Доставляється', $order->status_label);
    }

    public function test_order_status_label_completed(): void
    {
        $order = new Order(['status' => 'completed']);
        $this->assertEquals('Виконано', $order->status_label);
    }

    public function test_order_status_label_cancelled(): void
    {
        $order = new Order(['status' => 'cancelled']);
        $this->assertEquals('Скасовано', $order->status_label);
    }

    public function test_order_status_class_pending(): void
    {
        $order = new Order(['status' => 'pending']);
        $this->assertEquals('status-pending', $order->status_class);
    }

    public function test_order_status_class_completed(): void
    {
        $order = new Order(['status' => 'completed']);
        $this->assertEquals('status-completed', $order->status_class);
    }

    public function test_order_has_default_pending_status(): void
    {
        $order = Order::create([
            'name'    => 'Тест Користувач',
            'phone'   => '+380991234567',
            'email'   => 'test@test.com',
            'address' => 'вул. Тестова 1',
            'total'   => 500.00,
        ]);

        $this->assertEquals('pending', $order->status);
    }
}