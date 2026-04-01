@extends('admin.layout')

@section('title', 'Дашборд')
@section('header', 'Дашборд')

@section('content')

<div class="admin-stats">
  <div class="stat-card">
    <div class="stat-label">Всього товарів</div>
    <div class="stat-value">{{ $totalProducts }}</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Активних товарів</div>
    <div class="stat-value">{{ $activeProducts }}</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Користувачів</div>
    <div class="stat-value">{{ $totalUsers }}</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Замовлень</div>
    <div class="stat-value">0</div>
  </div>
</div>

@endsection