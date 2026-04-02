@extends('admin.layout')

@section('title', 'Додати товар')
@section('header', 'Додати товар')

@section('header-actions')
  <a href="{{ route('admin.products.index') }}" class="btn btn-ghost btn-sm">← Назад</a>
@endsection

@section('content')

<div style="max-width:700px">
  <div class="form-section">
    <form method="POST" action="{{ route('admin.products.store') }}">
      @csrf

      <div class="form-group">
        <label>Назва товару *</label>
        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
        @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label>Категорія *</label>
        <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
          <option value="">Оберіть категорію</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
        @error('category_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Ціна (₴) *</label>
          <input type="number" name="price" step="0.01" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" value="{{ old('price') }}">
          @error('price')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
          <label>Залишок (шт) *</label>
          <input type="number" name="stock" class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" value="{{ old('stock', 0) }}">
          @error('stock')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>
      </div>
      <div class="form-group">
  <label>Знижка (%) — залиш 0 якщо немає акції</label>
  <input type="number" name="discount" min="0" max="99" class="form-control" value="{{ old('discount', 0) }}">
</div>

      <div class="form-group">
        <label>Опис</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
      </div>

      <div class="form-group">
        <label>Посилання на фото (URL)</label>
        <input type="text" name="image" class="form-control" value="{{ old('image') }}" placeholder="https://...">
      </div>

      <div class="form-group" style="display:flex;align-items:center;gap:8px">
        <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
        <label for="is_active" style="margin:0;font-weight:400;font-size:14px">Активний (показувати в каталозі)</label>
      </div>

      <button type="submit" class="btn btn-primary btn-lg">Додати товар</button>
    </form>
  </div>
</div>

@endsection