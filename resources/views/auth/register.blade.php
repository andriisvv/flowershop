@extends('layouts.app')

@section('title', 'Реєстрація — FlowerShop')

@section('content')
<div class="auth-screen">
  <div class="auth-card">
    <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:8px">
      <span style="font-size:26px">🌸</span>
      <span style="font-family:var(--font-head);font-size:26px;font-weight:700;color:var(--rose)">FlowerShop</span>
    </div>
    <h2 class="auth-title">Реєстрація</h2>

    @if($errors->any())
      <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
      @csrf
      <div class="form-group">
        <label>Ім'я</label>
        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Марія Петренко">
        @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="email@example.com">
        @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label>Пароль</label>
        <input type="password" name="password" class="form-control" placeholder="мінімум 6 символів">
        @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label>Повторіть пароль</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
      </div>
      <button type="submit" class="btn btn-primary btn-lg btn-block">Зареєструватись</button>
    </form>

    <p class="auth-footer">Вже є акаунт? <a href="{{ route('login') }}">Увійти</a></p>
  </div>
</div>
@endsection