<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Arema Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
</head>
<body class="min-h-screen bg-slate-100">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-blue-900 text-white">
            <div class="px-4 py-4 border-b border-white/10 flex items-center gap-2">
                <img src="{{ asset('img/download.jpg') }}" alt="Arema" class="h-8 w-8">
                <div class="font-semibold">Admin Arema</div>
            </div>
            @php($routeName = request()->route()?->getName())
            <nav class="p-2 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded {{ $routeName==='admin.dashboard' ? 'bg-white/10 font-medium' : 'hover:bg-white/10' }}">Dashboard</a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-3 py-2 rounded {{ str_starts_with($routeName,'admin.categories.') ? 'bg-white/10 font-medium' : 'hover:bg-white/10' }}">Kategori</a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-3 py-2 rounded {{ str_starts_with($routeName,'admin.products.') ? 'bg-white/10 font-medium' : 'hover:bg-white/10' }}">Produk</a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-3 py-2 rounded {{ str_starts_with($routeName,'admin.orders.') ? 'bg-white/10 font-medium' : 'hover:bg-white/10' }}">Pesanan</a>
                <a href="{{ route('admin.news.index') }}" class="flex items-center px-3 py-2 rounded {{ str_starts_with($routeName,'admin.news.') ? 'bg-white/10 font-medium' : 'hover:bg-white/10' }}">Berita</a>
                <a href="{{ route('admin.standings.index') }}" class="flex items-center px-3 py-2 rounded {{ str_starts_with($routeName,'admin.standings.') ? 'bg-white/10 font-medium' : 'hover:bg-white/10' }}">Klasemen</a>
                <a href="{{ route('admin.header.index') }}" class="flex items-center px-3 py-2 rounded {{ str_starts_with($routeName,'admin.header.') ? 'bg-white/10 font-medium' : 'hover:bg-white/10' }}">Header</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="px-3 py-2">
                    @csrf
                    <button class="text-red-600">Logout</button>
                </form>
            </nav>
        </aside>
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
@stack('scripts')
</html>


