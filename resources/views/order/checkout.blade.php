@extends('layouts.app')

@section('title', 'Оформлення — FlowerShop')

@section('content')

<div class="checkout-wrap">
  <h1 class="page-title">✓ Оформлення замовлення</h1>

  <div class="checkout-grid">
    <div>
      <form method="POST" action="{{ route('order.store') }}">
        @csrf

        <div class="form-section">
          <h3>Контактні дані</h3>
          <div class="form-group">
            <label>Ім'я та прізвище *</label>
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
              value="{{ old('name', Auth::user()?->name) }}">
            @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>Телефон *</label>
              <input type="tel" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                value="{{ old('phone') }}" placeholder="+380991234567">
              @error('phone')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
              <label>Email *</label>
              <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                value="{{ old('email', Auth::user()?->email) }}">
              @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
          </div>
        </div>

        <div class="form-section">
          <h3>Доставка</h3>
          <div class="form-group">
            <label>Адреса доставки *</label>
            <textarea name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
              rows="2" placeholder="вул. Назва, будинок, квартира, місто">{{ old('address') }}</textarea>
            @error('address')<span class="invalid-feedback">{{ $message }}</span>@enderror
          </div>
          <div class="form-group">
            <label>Коментар до замовлення</label>
            <textarea name="comment" class="form-control" rows="2"
              placeholder="Побажання, зручний час доставки...">{{ old('comment') }}</textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">✓ Підтвердити замовлення</button>
      </form>
    </div>

    <div class="card summary-card">
      <h3>Ваше замовлення</h3>
      @foreach($products as $item)
        <div class="summary-row">
          <span class="label">{{ $item['product']->name }} × {{ $item['quantity'] }}</span>
          <span class="value">{{ number_format($item['subtotal'], 2) }} ₴</span>
        </div>
      @endforeach
      <hr class="summary-divider">
      <div class="summary-row summary-total">
        <span class="label">Разом:</span>
        <span class="value">{{ number_format($total, 2) }} ₴</span>
      </div>
      <a href="{{ route('cart') }}" class="btn btn-ghost btn-sm btn-block"
        style="margin-top:16px;border:1.5px solid var(--border-d)">← Назад до кошика</a>
    </div>
  </div>
</div>

@endsection