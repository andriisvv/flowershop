@extends('admin.layout')

@section('title', 'Замовлення')
@section('header', 'Замовлення')

@section('content')

<div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden">
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Дата</th>
        <th>Клієнт</th>
        <th>Телефон</th>
        <th>Сума</th>
        <th>Статус</th>
        <th>Дія</th>
      </tr>
    </thead>
    <tbody>
      @forelse($orders as $order)
      <tr>
        <td><strong>#{{ $order->id }}</strong></td>
        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
        <td>{{ $order->name }}</td>
        <td>{{ $order->phone }}</td>
        <td><strong>{{ number_format($order->total, 2) }} ₴</strong></td>
        <td><span class="status {{ $order->status_class }}">{{ $order->status_label }}</span></td>
      <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline btn-sm">👁 Деталі</a></td>
      </tr>
      @empty
      <tr>
        <td colspan="7" style="text-align:center;padding:40px;color:var(--text-3)">
          Замовлень поки немає
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="pagination">
  {{ $orders->links() }}
</div>

@endsection