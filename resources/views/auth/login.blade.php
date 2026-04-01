@extends('layouts.app')

@section('title', 'Вхід — FlowerShop')

@section('content')
<div class="auth-screen">
  <div class="auth-card">
    <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:8px">
      <span style="font-size:26px">🌸</span>
      <span style="font-family:var(--font-head);font-size:26px;font-weight:700;color:var(--rose)">FlowerShop</span>
    </div>
    <h2 class="auth-title">Вхід до акаунту</h2>

    @if($errors->any())
      <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
      @csrf
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
        @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label>Пароль</label>
        <input type="password" name="password" class="form-control" placeholder="••••••••">
      </div>
      <div class="form-group" style="display:flex;align-items:center;gap:8px">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember" style="margin:0;font-weight:400;font-size:14px;color:var(--text-2)">Запам'ятати мене</label>
      </div>
      <button type="submit" class="btn btn-primary btn-lg btn-block">Увійти</button>
    </form>

    <p class="auth-footer">Ще немає акаунту? <a href="{{ route('register') }}">Зареєструватись</a></p>
  </div>
</div>
@endsection