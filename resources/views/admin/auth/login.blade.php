<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Arema Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
      .bg-navy { background-color: #0b1b3b; }
    </style>
    <script>
      (function(){
        const saved = localStorage.getItem('arema-theme');
        if (saved === 'dark') document.documentElement.classList.add('dark');
      })();
    </script>
  </head>
  <body class="min-h-screen bg-slate-100 flex items-center justify-center">
    <div class="w-full max-w-md">
      <div class="text-center mb-6">
        <a href="/" class="inline-flex items-center gap-2">
          <img src="{{ asset('img/download.jpg') }}" alt="Arema" class="h-10 w-10 rounded">
          <div class="text-slate-800 font-semibold">Arema Official Store</div>
        </a>
      </div>

      <div class="bg-white shadow rounded overflow-hidden">
        <div class="bg-navy text-white px-5 py-4">Login Admin</div>
        <div class="p-6">
          @if ($errors->any())
            <div class="mb-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded p-3">
              {{ $errors->first() }}
            </div>
          @endif

          <form method="POST" action="{{ route('admin.login.attempt') }}" class="space-y-4">
            @csrf
            <div>
              <label class="block text-sm font-medium mb-1 text-slate-700">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" required>
            </div>
            <div>
              <label class="block text-sm font-medium mb-1 text-slate-700">Password</label>
              <div class="relative">
                <input id="passwordInput" type="password" name="password" class="w-full border rounded px-3 py-2 pr-10 focus:outline-none focus:ring" required>
                <button type="button" id="togglePassword" class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800" aria-label="Lihat password">
                  <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                    <path d="M1.5 12S5.25 4.5 12 4.5 22.5 12 22.5 12 18.75 19.5 12 19.5 1.5 12 1.5 12Zm10.5 3.75A3.75 3.75 0 1 0 8.25 12 3.75 3.75 0 0 0 12 15.75Z"/>
                  </svg>
                </button>
              </div>
            </div>
            <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white rounded px-4 py-2">Masuk</button>
          </form>
        </div>
      </div>

      <div class="text-center mt-4">
        <a href="/" class="text-sm text-slate-500 hover:text-slate-700">← Kembali ke beranda</a>
      </div>
    </div>
  </body>
  <script>
    (function(){
      const btn = document.getElementById('togglePassword');
      const input = document.getElementById('passwordInput');
      const icon = document.getElementById('eyeIcon');
      if (!btn || !input || !icon) return;
      let shown = false;
      btn.addEventListener('click', () => {
        shown = !shown;
        input.type = shown ? 'text' : 'password';
        icon.innerHTML = shown
          ? '<path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l2.18 2.18C2.86 7 1.77 9.07 1.5 9.56c-.17.33-.17.73 0 1.06 0 0 3.75 7.38 10.5 7.38 2.02 0 3.74-.57 5.14-1.37l2.33 2.33a.75.75 0 1 0 1.06-1.06L3.53 2.47ZM12 17.25c-5.21 0-8.49-4.77-9.67-6.69.47-.83 1.53-2.41 3.13-3.76l2.06 2.06A3.75 3.75 0 0 0 12 15.75c.66 0 1.28-.17 1.82-.45l1.54 1.54c-.86.26-1.79.41-2.36.41Zm0-2.25c-1.5 0-2.75-1.25-2.75-2.75 0-.45.11-.86.31-1.23l3.67 3.67c-.37.2-.78.31-1.23.31Z"/>'
          : '<path d="M1.5 12S5.25 4.5 12 4.5 22.5 12 22.5 12 18.75 19.5 12 19.5 1.5 12 1.5 12Zm10.5 3.75A3.75 3.75 0 1 0 8.25 12 3.75 3.75 0 0 0 12 15.75Z"/>';
      });
    })();
  </script>
</html>


