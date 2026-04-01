@extends('admin.layout')

@section('title', 'Замовлення #' . $order->id)
@section('header', 'Замовлення #' . $order->id)

@section('header-actions')
  <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost btn-sm">← Назад</a>
@endsection

@section('content')

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div style="display:grid;grid-template-columns:1fr 320px;gap:24px">

  <div>
    <div class="form-section">
      <h3>Товари замовлення</h3>
      <table class="table">
        <thead>
          <tr>
            <th>Товар</th>
            <th>Ціна</th>
            <th>Кількість</th>
            <th>Сума</th>
          </tr>
        </thead>
        <tbody>
          @foreach($order->items as $item)
          <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ number_format($item->price, 2) }} ₴</td>
            <td>{{ $item->quantity }}</td>
            <td><strong>{{ number_format($item->price * $item->quantity, 2) }} ₴</strong></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" style="text-align:right">Разом:</td>
            <td><strong>{{ number_format($order->total, 2) }} ₴</strong></td>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="form-section">
      <h3>Контактні дані</h3>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;font-size:14px">
        <div>
          <div style="color:var(--text-3);margin-bottom:4px">Ім'я</div>
          <div>{{ $order->name }}</div>
        </div>
        <div>
          <div style="color:var(--text-3);margin-bottom:4px">Телефон</div>
          <div>{{ $order->phone }}</div>
        </div>
        <div>
          <div style="color:var(--text-3);margin-bottom:4px">Email</div>
          <div>{{ $order->email }}</div>
        </div>
        <div>
          <div style="color:var(--text-3);margin-bottom:4px">Адреса</div>
          <div>{{ $order->address }}</div>
        </div>
        @if($order->comment)
        <div style="grid-column:span 2">
          <div style="color:var(--text-3);margin-bottom:4px">Коментар</div>
          <div>{{ $order->comment }}</div>
        </div>
        @endif
      </div>
    </div>
  </div>

  <div>
    <div class="card" style="padding:24px">
      <h3 style="font-family:var(--font-head);font-size:18px;margin-bottom:16px">Статус замовлення</h3>
      <div style="margin-bottom:16px">
        <span class="status {{ $order->status_class }}">{{ $order->status_label }}</span>
      </div>
      <form method="POST" action="{{ route('admin.orders.status', $order->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label>Змінити статус</label>
          <select name="status" class="form-control">
            <option value="pending"    {{ $order->status == 'pending'    ? 'selected' : '' }}>Очікує</option>
            <option value="confirmed"  {{ $order->status == 'confirmed'  ? 'selected' : '' }}>Підтверджено</option>
            <option value="delivering" {{ $order->status == 'delivering' ? 'selected' : '' }}>Доставляється</option>
            <option value="completed"  {{ $order->status == 'completed'  ? 'selected' : '' }}>Виконано</option>
            <option value="cancelled"  {{ $order->status == 'cancelled'  ? 'selected' : '' }}>Скасовано</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Зберегти статус</button>
      </form>
    </div>

    <div class="card" style="padding:24px;margin-top:16px">
      <h3 style="font-family:var(--font-head);font-size:18px;margin-bottom:12px">Інфо</h3>
      <div style="font-size:13px;color:var(--text-2)">
        <div style="margin-bottom:8px">📅 {{ $order->created_at->format('d.m.Y H:i') }}</div>
        <div style="margin-bottom:8px">👤 {{ $order->user?->name ?? 'Гість' }}</div>
        <div>💰 {{ number_format($order->total, 2) }} ₴</div>
      </div>
    </div>
  </div>

</div>

@endsection