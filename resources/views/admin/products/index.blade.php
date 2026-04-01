@extends('admin.layout')

@section('title', 'Товари')
@section('header', 'Товари')

@section('header-actions')
  <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">+ Додати товар</a>
@endsection

@section('content')

<div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden">
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Фото</th>
        <th>Назва</th>
        <th>Категорія</th>
        <th>Ціна</th>
        <th>Залишок</th>
        <th>Статус</th>
        <th>Дії</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>
          <div style="width:44px;height:44px;background:var(--rose-xl);border-radius:6px;overflow:hidden;display:flex;align-items:center;justify-content:center">
            @if($product->image)
              <img src="{{ $product->image }}" style="width:100%;height:100%;object-fit:cover">
            @else
              🌸
            @endif
          </div>
        </td>
        <td><strong>{{ $product->name }}</strong></td>
        <td>{{ $product->category->name }}</td>
        <td>{{ number_format($product->price, 2) }} ₴</td>
        <td style="{{ $product->stock == 0 ? 'color:var(--danger);font-weight:600' : '' }}">{{ $product->stock }}</td>
        <td>
          @if($product->is_active)
            <span class="badge badge-success">Активний</span>
          @else
            <span class="badge badge-danger">Прихований</span>
          @endif
        </td>
        <td style="white-space:nowrap">
          <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline btn-sm" style="margin-right:6px">✏️ Ред.</a>
          <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display:inline" onsubmit="return confirm('Видалити товар?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">🗑</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="pagination">
  {{ $products->links() }}
</div>

@endsection