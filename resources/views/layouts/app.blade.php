<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>{{ $title ?? 'Tienda Virtual' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite('resources/css/app.css')
</head>
<body class="antialiased">
  <header>
    <a href="{{ route('home') }}">Tienda Virtual</a>
    <form action="{{ route('product.search') }}" method="get">
      <input name="q" placeholder="Buscar productos..." value="{{ request('q') }}">
    </form>
  </header>

  <main>
    @yield('content')
  </main>

  <footer>© {{ date('Y') }}</footer>
  @vite('resources/js/app.js')
</body>
</html>
