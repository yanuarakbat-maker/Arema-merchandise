<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arema Official Store</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="m-0 min-h-screen flex flex-col bg-slate-50">
  <header class="bg-blue-900 text-white">
    <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
      <a href="/" class="flex items-center gap-2">
        <img src="{{ asset('img/download.jpg') }}" alt="Arema" class="h-8 w-8">
        <span class="font-semibold">Arema Official Store</span>
      </a>
      <nav class="flex items-center gap-1">
        @php($path = request()->path())
        <a href="/" class="px-3 py-2 rounded {{ $path === '/' || $path === '' ? 'bg-white/10' : 'hover:bg-white/10' }}">Home</a>
        <a href="/products" class="px-3 py-2 rounded {{ str_starts_with($path, 'products') ? 'bg-white/10' : 'hover:bg-white/10' }}">Produk</a>
        <a href="/about" class="px-3 py-2 rounded {{ str_starts_with($path, 'about') ? 'bg-white/10' : 'hover:bg-white/10' }}">Tentang</a>
        <a href="/contact" class="px-3 py-2 rounded {{ str_starts_with($path, 'contact') ? 'bg-white/10' : 'hover:bg-white/10' }}">Kontak</a>
        <a href="{{ route('cart.index') }}" class="relative ml-2 px-3 py-2 rounded hover:bg-white/10" title="Keranjang">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25A3.75 3.75 0 0 0 11.25 18h1.5a3.75 3.75 0 0 0 3.75-3.75V6.75A3.75 3.75 0 0 0 12.75 3h-1.5A3.75 3.75 0 0 0 7.5 6.75v7.5z" />
          </svg>
          @php($cartCount = is_array(session('cart')) ? array_sum(array_column(session('cart'), 'qty')) : 0)
          @if($cartCount > 0)
            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full px-1.5 py-0.5">{{ $cartCount }}</span>
          @endif
        </a>
        @auth
          <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded {{ $path === 'dashboard' ? 'bg-white/10' : 'hover:bg-white/10' }}">Akun</a>
        @else
          <a href="{{ route('login') }}" class="px-3 py-2 rounded hover:bg-white/10">Login</a>
          <a href="{{ route('register') }}" class="px-3 py-2 rounded hover:bg-white/10">Register</a>
        @endauth
        <button id="themeToggle" class="ml-2 px-3 py-2 rounded border border-white/30 hover:bg-white/10" title="Ganti tema" aria-label="Ganti tema">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
            <path d="M21.752 15.002A9.718 9.718 0 0 1 12 21.75c-5.385 0-9.75-4.365-9.75-9.75 0-4.184 2.654-7.745 6.36-9.108a.75.75 0 0 1 .967.967A8.25 8.25 0 0 0 20.25 15.72a.75.75 0 0 1 1.502-.718Z"/>
          </svg>
        </button>
      </nav>
    </div>
  </header>
  <main class="flex-1">
    @yield('content')
  </main>
  <footer class="bg-white border-t">
    <div class="max-w-6xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-6 text-sm text-slate-600">
      <div class="flex items-center gap-2">
        <img src="{{ asset('img/download.jpg') }}" alt="Arema" class="h-8 w-8">
        <div>
          <div class="font-semibold text-slate-800">Arema Official Store</div>
          <div class="text-slate-500">Merchandise resmi Arema FC.</div>
        </div>
      </div>
      <div>
        <div class="font-medium text-slate-800 mb-2">Menu</div>
        <div class="space-y-1">
          <a href="/" class="block hover:underline">Home</a>
          <a href="/products" class="block hover:underline">Produk</a>
          <a href="/about" class="block hover:underline">Tentang</a>
          <a href="/contact" class="block hover:underline">Kontak</a>
        </div>
      </div>
      <div class="md:text-right">
        <div class="font-medium text-slate-800 mb-2">Lainnya</div>
        <a class="hover:underline" href="/admin">Masuk Admin</a>
        <div class="text-slate-500 mt-2">© {{ date('Y') }} Arema Official Store</div>
      </div>
    </div>
  </footer>

  <script>
    (function(){
      const root = document.documentElement;
      const key = 'arema-theme';
      const saved = localStorage.getItem(key);
      if (saved === 'dark') root.classList.add('dark');
      const btn = document.getElementById('themeToggle');
      if (btn) {
        btn.addEventListener('click', () => {
          root.classList.toggle('dark');
          localStorage.setItem(key, root.classList.contains('dark') ? 'dark' : 'light');
        });
      }
    })();
  </script>

  @stack('scripts')
</body>
</html>


