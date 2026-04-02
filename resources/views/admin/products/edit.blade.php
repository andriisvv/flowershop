@extends('admin.layout')

@section('title', 'Редагувати товар')
@section('header', 'Редагувати товар')

@section('header-actions')
  <a href="{{ route('admin.products.index') }}" class="btn btn-ghost btn-sm">← Назад</a>
@endsection

@section('content')

<div style="max-width:700px">
  <div class="form-section">
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label>Назва товару *</label>
        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $product->name) }}">
        @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label>Категорія *</label>
        <select name="category_id" class="form-control">
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-row">
  <div class="form-group">
    <label>Ціна (₴) *</label>
    <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $product->price) }}">
  </div>
  <div class="form-group">
    <label>Залишок (шт) *</label>
    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
  </div>
</div>
<div class="form-group">
  <label>Знижка (%) — залиш 0 якщо немає акції</label>
  <input type="number" name="discount" min="0" max="99" class="form-control" value="{{ old('discount', $product->discount) }}">
</div>

      <div class="form-group">
        <label>Опис</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
      </div>

      <div class="form-group">
        <label>Посилання на фото (URL)</label>
        <input type="text" name="image" class="form-control" value="{{ old('image', $product->image) }}">
        @if($product->image)
          <img src="{{ $product->image }}" style="margin-top:8px;height:80px;border-radius:6px;object-fit:cover">
        @endif
      </div>

      <div class="form-group" style="display:flex;align-items:center;gap:8px">
        <input type="checkbox" name="is_active" id="is_active" {{ $product->is_active ? 'checked' : '' }}>
        <label for="is_active" style="margin:0;font-weight:400;font-size:14px">Активний (показувати в каталозі)</label>
      </div>

      <button type="submit" class="btn btn-primary btn-lg">Зберегти зміни</button>
    </form>
  </div>
</div>

@endsection