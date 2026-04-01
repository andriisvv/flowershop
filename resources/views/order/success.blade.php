@extends('layouts.app')

@section('title', 'Замовлення оформлено — FlowerShop')

@section('content')

<div style="padding:60px 48px;text-align:center">
  <div style="font-size:72px;margin-bottom:20px">🌸</div>
  <h1 style="font-family:var(--font-head);font-size:32px;color:var(--text);margin-bottom:12px">
    Дякуємо за замовлення!
  </h1>
  <p style="color:var(--text-2);font-size:16px;margin-bottom:8px">
    Замовлення <strong>#{{ $order->id }}</strong> успішно оформлено
  </p>
  <p style="color:var(--text-2);font-size:15px;margin-bottom:32px">
    Ми зв'яжемось з вами за номером <strong>{{ $order->phone }}</strong>
  </p>

  <div class="card" style="max-width:500px;margin:0 auto 32px;padding:24px;text-align:left">
    <h3 style="font-family:var(--font-head);font-size:18px;margin-bottom:16px">Деталі замовлення</h3>
    @foreach($order->items as $item)
      <div class="summary-row">
        <span class="label">{{ $item->product->name }} × {{ $item->quantity }}</span>
        <span class="value">{{ number_format($item->price * $item->quantity, 2) }} ₴</span>
      </div>
    @endforeach
    <hr class="summary-divider">
    <div class="summary-row summary-total">
      <span class="label">Разом:</span>
      <span class="value">{{ number_format($order->total, 2) }} ₴</span>
    </div>
    <div style="margin-top:16px;font-size:14px;color:var(--text-2)">
      <div>📍 {{ $order->address }}</div>
      @if($order->comment)
        <div style="margin-top:6px">💬 {{ $order->comment }}</div>
      @endif
    </div>
  </div>

  <div style="display:flex;gap:12px;justify-content:center">
    <a href="{{ route('catalog') }}" class="btn btn-primary btn-lg">Продовжити покупки</a>
    @auth
      <a href="{{ route('my.orders') }}" class="btn btn-outline btn-lg">Мої замовлення</a>
    @endauth
  </div>
</div>

@endsection