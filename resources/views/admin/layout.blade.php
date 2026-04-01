<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Адмін') — FlowerShop</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>
<body>
<div class="admin-layout">

  <aside class="admin-sidebar">
    <div class="admin-sidebar-logo">🌸 FlowerShop</div>
    <nav class="admin-nav">
      <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">🌿 Товари</a>
      <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">📦 Замовлення</a>
      <a href="{{ route('catalog') }}">🏠 На сайт</a>
    </nav>
    <div class="admin-sidebar-footer">{{ Auth::user()->name }}</div>
  </aside>

  <div class="admin-main">
    <header class="admin-header">
      <h1>@yield('header')</h1>
      <div style="display:flex;gap:8px;align-items:center">
        @yield('header-actions')
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-ghost btn-sm">Вийти</button>
        </form>
      </div>
    </header>

    <div class="admin-content">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @yield('content')
    </div>
  </div>

</div>
</body>
</html>