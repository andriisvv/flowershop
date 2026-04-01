@extends('layouts.app')

@section('title', 'Акції — FlowerShop')

@section('content')

<div class="hero" style="background:linear-gradient(135deg, #6b8f71 0%, #4a7a52 100%)">
  <div class="hero-content">
    <div class="hero-tag">🏷 Спеціальні пропозиції</div>
    <h1>Акції та знижки</h1>
    <p>Найкращі квіти за спеціальними цінами</p>
  </div>
</div>

<div class="catalog-layout">
  <aside class="sidebar-panel">
    <div class="sidebar-section">
      <h4>Категорії</h4>
      <a href="{{ route('catalog') }}" class="sidebar-link">Всі квіти</a>
      @foreach($categories as $category)
        <a href="{{ route('catalog', ['category' => $category->slug]) }}" class="sidebar-link">
          {{ $category->name }}
          <span class="sidebar-count">{{ $category->products_count }}</span>
        </a>
      @endforeach
    </div>
  </aside>

  <div class="products-area">
    @if($products->isEmpty())
      <div class="empty-state">
        <div class="emoji">🏷</div>
        <h3>Акцій поки немає</h3>
        <p>Слідкуйте за оновленнями!</p>
        <a href="{{ route('catalog') }}" class="btn btn-primary">До каталогу</a>
      </div>
    @else
      <div class="products-grid">
        @foreach($products as $product)
          <div class="product-card">
            <div class="product-thumb" style="padding:0;overflow:hidden;position:relative">
              <span style="position:absolute;top:10px;left:10px;z-index:1;background:var(--danger);color:#fff;font-size:11px;font-weight:700;padding:3px 8px;border-radius:10px">
                -{{ $product->discount }}%
              </span>
              @if($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover">
              @else
                🌸
              @endif
            </div>
            <div class="product-body">
              <div class="product-cat">{{ $product->category->name }}</div>
              <a href="{{ route('product.show', $product->id) }}" class="product-name" style="text-decoration:none;color:inherit">{{ $product->name }}</a>
              <div class="product-footer">
                <div>
                  <span class="product-price">{{ number_format($product->discounted_price, 2) }} ₴</span>
                  <span style="font-size:12px;color:var(--text-3);text-decoration:line-through;margin-left:6px">{{ number_format($product->price, 2) }} ₴</span>
                </div>
                <form method="POST" action="{{ route('cart.add') }}">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <button type="submit" class="btn btn-primary btn-sm">🛒 Кошик</button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="pagination">
        {{ $products->links() }}
      </div>
    @endif
  </div>
</div>

@endsection