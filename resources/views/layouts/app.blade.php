<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'FlowerShop')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>
<body>

  <header class="header">
    <a href="{{ route('catalog') }}" class="logo">🌸 FlowerShop</a>
    <nav class="header-nav">
  <a href="{{ route('catalog') }}" class="{{ request()->routeIs('catalog') && !request('category') ? 'active' : '' }}">Каталог</a>
  <a href="{{ route('catalog', ['category' => 'troyandi']) }}" class="{{ request('category') == 'troyandi' ? 'active' : '' }}">Троянди</a>
  <a href="{{ route('catalog', ['category' => 'bukety']) }}" class="{{ request('category') == 'bukety' ? 'active' : '' }}">Букети</a>
  <a href="{{ route('catalog', ['category' => 'tyulpany']) }}" class="{{ request('category') == 'tyulpany' ? 'active' : '' }}">Тюльпани</a>
  <a href="{{ route('catalog', ['category' => 'orchideyi']) }}" class="{{ request('category') == 'orchideyi' ? 'active' : '' }}">Орхідеї</a>
  <a href="{{ route('sales') }}" class="{{ request()->routeIs('sales') ? 'active' : '' }}">Акції</a>
</nav>
  <div class="header-actions">
  <a href="{{ route('cart') }}" class="btn btn-outline btn-sm">🛒 Кошик</a>
@auth
  <a href="{{ route('my.orders') }}" class="btn btn-ghost btn-sm">Мої замовлення</a>
  <span style="font-size:14px;color:var(--text-2)">{{ Auth::user()->name }}</span>
  <form method="POST" action="{{ route('logout') }}" style="display:inline">
    @csrf
    <button type="submit" class="btn btn-ghost btn-sm">Вийти</button>
  </form>
@else
  <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Увійти</a>
  <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Реєстрація</a>
@endauth
</div>
  </header>

  @yield('content')

  <footer class="footer">
    <div class="footer-logo">🌸 FlowerShop</div>
    <div>вул. Квіткова 1, Київ &nbsp;|&nbsp; +380 99 123 45 67</div>
    <div>© 2026 FlowerShop. Всі права захищено.</div>
  </footer>

</body>
</html>