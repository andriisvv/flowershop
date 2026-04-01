@extends('layouts.app')

@section('title', 'Кошик — FlowerShop')

@section('content')

<div class="cart-wrap">
  <h1 class="page-title">🛒 Кошик</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(empty($products))
    <div class="empty-state">
      <div class="emoji">🛒</div>
      <h3>Кошик порожній</h3>
      <p>Додайте квіти з каталогу</p>
      <a href="{{ route('catalog') }}" class="btn btn-primary">Перейти до каталогу</a>
    </div>
  @else
    <div class="cart-layout">
      <div>
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden">
          <table class="table">
            <thead>
              <tr>
                <th>Товар</th>
                <th>Ціна</th>
                <th>Кількість</th>
                <th>Сума</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $item)
              <tr>
                <td>
                  <div class="cart-product-cell">
                    <div class="cart-thumb">
                      @if($item['product']->image)
                        <img src="{{ $item['product']->image }}" style="width:100%;height:100%;object-fit:cover;border-radius:var(--r-sm)">
                      @else
                        🌸
                      @endif
                    </div>
                    <div class="cart-product-info">
                      <div class="name">{{ $item['product']->name }}</div>
                      <div class="cat">{{ $item['product']->category->name }}</div>
                    </div>
                  </div>
                </td>
                <td>{{ number_format($item['product']->price, 2) }} ₴</td>
                <td>
                  <form method="POST" action="{{ route('cart.update') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                    <div class="qty-ctrl">
                      <div class="qty-val">
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width:60px;text-align:center;padding:4px 8px" onchange="this.form.submit()">
                      </div>
                    </div>
                  </form>
                </td>
                <td><strong>{{ number_format($item['subtotal'], 2) }} ₴</strong></td>
                <td>
                  <form method="POST" action="{{ route('cart.remove') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                    <button type="submit" class="del-btn">✕</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="cart-actions">
          <form method="POST" action="{{ route('cart.clear') }}">
            @csrf
            <button type="submit" class="btn btn-ghost btn-sm" style="border:1.5px solid var(--border-d)">🗑 Очистити кошик</button>
          </form>
          <a href="{{ route('catalog') }}" class="btn btn-outline btn-sm">← Продовжити покупки</a>
        </div>
      </div>

      <div class="card summary-card">
        <h3>Підсумок</h3>
        <div class="summary-row">
          <span class="label">Товарів:</span>
          <span class="value">{{ count($products) }} шт.</span>
        </div>
        <div class="summary-row">
          <span class="label">Доставка:</span>
          <span class="value" style="color:var(--success)">Безкоштовно</span>
        </div>
        <hr class="summary-divider">
        <div class="summary-row summary-total">
          <span class="label">Разом:</span>
          <span class="value">{{ number_format($total, 2) }} ₴</span>
        </div>
        <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg btn-block" style="margin-top:20px">Оформити замовлення →</a>
        <a href="{{ route('catalog') }}" class="btn btn-ghost btn-sm btn-block" style="margin-top:8px;border:1.5px solid var(--border-d)">← Назад до каталогу</a>
      </div>
    </div>
  @endif
</div>

@endsection