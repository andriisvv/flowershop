@extends('layouts.app')

@section('title', $product->name . ' — FlowerShop')

@section('content')

<div class="product-detail-wrap">

  <div class="breadcrumb">
    <a href="{{ route('catalog') }}">Головна</a> <span>/</span>
    <a href="{{ route('catalog') }}">Каталог</a> <span>/</span>
    <a href="{{ route('catalog', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a> <span>/</span>
    <span>{{ $product->name }}</span>
  </div>

  <div class="product-detail-grid">
    <div>
    <div class="product-main-img" style="padding:0;overflow:hidden">
  @if($product->image)
    <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:var(--r-lg)">
  @else
    🌸
  @endif
</div>
      <div class="product-thumbs">
        <div class="product-thumb-sm active">🌸</div>
        <div class="product-thumb-sm">🌸</div>
        <div class="product-thumb-sm">🌸</div>
      </div>
    </div>

    <div class="product-detail-info">
      <div class="badge-cat">🌿 {{ $product->category->name }}</div>
      <h1>{{ $product->name }}</h1>
      <div class="detail-price">{{ number_format($product->price, 2) }} ₴</div>

      @if($product->stock > 0)
        <div class="stock-status in">✓ В наявності ({{ $product->stock }} шт.)</div>
      @else
        <div class="stock-status out">✗ Немає в наявності</div>
      @endif

      @if($product->description)
        <p class="product-desc">{{ $product->description }}</p>
      @endif

      @if($product->stock > 0)
        <div class="qty-row">
          <label>Кількість:</label>
          <input type="number" class="qty-input form-control" value="1" min="1" max="{{ $product->stock }}" style="width:90px">
        </div>
        <button class="btn btn-primary btn-lg btn-block">🛒 Додати до кошика</button>
        <button class="btn btn-ghost btn-sm btn-block" style="margin-top:10px;border:1.5px solid var(--border-d)">♡ В обране</button>
      @else
        <button class="btn btn-ghost btn-lg btn-block" disabled style="color:var(--text-3);border:1.5px solid var(--border-d)">Немає в наявності</button>
      @endif
    </div>
  </div>

  @if($related->count() > 0)
    <div>
      <h2 class="section-title">Схожі товари</h2>
      <div class="products-grid" style="grid-template-columns:repeat(4,1fr)">
        @foreach($related as $item)
          <div class="product-card">
            <div class="product-thumb" style="height:150px">🌸</div>
            <div class="product-body">
              <div class="product-cat">{{ $item->category->name }}</div>
              <div class="product-name">{{ $item->name }}</div>
              <div class="product-footer">
                <span class="product-price">{{ number_format($item->price, 2) }} ₴</span>
                <a href="{{ route('product.show', $item->id) }}" class="btn btn-primary btn-sm">🛒</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endif

</div>

@endsection