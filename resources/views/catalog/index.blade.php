@extends('layouts.app')

@section('title', 'Каталог — FlowerShop')

@section('content')

<div class="hero">
  <div class="hero-content">
    <div class="hero-tag">🌿 Свіжі квіти щодня</div>
    <h1>Найкращі квіти для найкращих моментів</h1>
    <p>Доставка по Україні · 6 категорій · Більше 40 видів</p>
    <div class="hero-actions">
      <a href="#catalog" class="btn btn-hero-primary">Переглянути каталог →</a>
      <a href="{{ route('sales') }}" class="btn btn-hero-outline">Акції</a>
    </div>
  </div>
</div>

<div class="catalog-layout" id="catalog">
  <aside class="sidebar-panel">
    <div class="sidebar-section">
      <h4>Категорії</h4>
      <a href="{{ route('catalog') }}" class="sidebar-link {{ !request('category') ? 'active' : '' }}">
        Всі квіти <span class="sidebar-count">{{ $categories->sum('products_count') }}</span>
      </a>
      @foreach($categories as $category)
        <a href="{{ route('catalog', ['category' => $category->slug]) }}"
           class="sidebar-link {{ request('category') == $category->slug ? 'active' : '' }}">
          {{ $category->name }}
          <span class="sidebar-count">{{ $category->products_count }}</span>
        </a>
      @endforeach
    </div>
    <div class="sidebar-section">
  <h4>Пошук</h4>
  <form method="GET" action="{{ route('catalog') }}">
    @if(request('category'))
      <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
    <input type="text" name="search" class="form-control" placeholder="Назва квітки..." value="{{ request('search') }}">
    <button type="submit" class="btn btn-primary btn-sm btn-block" style="margin-top:10px">🔍 Знайти</button>
    @if(request('search'))
      <a href="{{ route('catalog') }}" class="btn btn-ghost btn-sm btn-block" style="margin-top:6px">✕ Скинути</a>
    @endif
  </form>
</div>
  </aside>

  <div class="products-area">
    <div class="products-grid">
      @foreach($products as $product)
        <div class="product-card">
        <div class="product-thumb" style="padding:0;overflow:hidden">
  @if($product->stock == 0)
    <span class="stock-badge out" style="position:absolute;top:10px;left:10px;z-index:1">Немає</span>
  @elseif($product->stock <= 5)
    <span class="stock-badge" style="position:absolute;top:10px;left:10px;z-index:1">Залишок {{ $product->stock }}</span>
  @endif
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
              <span class="product-price">{{ number_format($product->price, 2) }} ₴</span>
              @if($product->stock > 0)
                <form method="POST" action="{{ route('cart.add') }}">
  @csrf
  <input type="hidden" name="product_id" value="{{ $product->id }}">
  <button type="submit" class="btn btn-primary btn-sm">🛒 Кошик</button>
</form>
              @else
                <button class="btn btn-ghost btn-sm" disabled style="color:var(--text-3);border:1.5px solid var(--border-d)">Немає</button>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="pagination">
      {{ $products->links() }}
    </div>
  </div>
</div>

@endsection