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
      <a href="{{ route('catalog') }}" class="{{ request()->routeIs('catalog') ? 'active' : '' }}">Каталог</a>
      <a href="#">Троянди</a>
      <a href="#">Букети</a>
      <a href="#">Тюльпани</a>
    </nav>
    <div class="header-actions">
      <a href="#" class="btn btn-outline btn-sm">🛒 Кошик</a>
      <a href="#" class="btn btn-ghost btn-sm">Увійти</a>
      <a href="#" class="btn btn-primary btn-sm">Реєстрація</a>
    </div>
  </header>

  @yield('content')

  <footer class="footer">
    <div class="footer-logo">🌸 FlowerShop</div>
    <div>вул. Квіткова 1, Київ &nbsp;|&nbsp; +380 99 123 45 67</div>
    <div>© 2025 FlowerShop. Всі права захищено.</div>
  </footer>

</body>
</html>