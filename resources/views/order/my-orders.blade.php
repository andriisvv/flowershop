@extends('layouts.app')

@section('title', 'Мої замовлення — FlowerShop')

@section('content')

<div class="orders-wrap">
  <h1 class="page-title">📦 Мої замовлення</h1>

  @if($orders->isEmpty())
    <div class="empty-state">
      <div class="emoji">📦</div>
      <h3>Замовлень поки немає</h3>
      <p>Зробіть перше замовлення в каталозі</p>
      <a href="{{ route('catalog') }}" class="btn btn-primary">Перейти до каталогу</a>
    </div>
  @else
    <div style="background:var(--surface);border-radius:var(--r-lg);overflow:hidden;border:1px solid var(--border)">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Дата</th>
            <th>Товари</th>
            <th>Сума</th>
            <th>Статус</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td><strong>#{{ $order->id }}</strong></td>
            <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
            <td>{{ $order->items->count() }} позицій</td>
            <td><strong>{{ number_format($order->total, 2) }} ₴</strong></td>
            <td><span class="status {{ $order->status_class }}">{{ $order->status_label }}</span></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>

@endsection