@extends('layouts.public')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
  <div class="flex items-end justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold">Produk</h1>
      <p class="text-slate-500">Koleksi merchandise resmi Arema FC.</p>
    </div>
  </div>

  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
    @forelse($products as $product)
      <div class="group bg-white rounded-lg shadow-sm ring-1 ring-slate-200 overflow-hidden hover:shadow-md hover:-translate-y-0.5 transition-all">
        <div class="aspect-square bg-slate-100 overflow-hidden">
          @php
            $mainImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
          @endphp
          @if($mainImage)
            <img src="{{ asset('storage/'.$mainImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform">
          @elseif($product->image_path)
            <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform">
          @else
            <div class="w-full h-full flex items-center justify-center text-slate-400 text-sm">No Image</div>
          @endif
        </div>
        <div class="p-3">
          <div class="text-xs inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-blue-50 text-blue-700">
            {{ $product->category->name ?? 'Tanpa Kategori' }}
          </div>
          <div class="mt-2 font-medium text-slate-800 line-clamp-2">{{ $product->name }}</div>
          <form method="POST" action="{{ route('cart.add', $product->id) }}" class="add-to-cart-form mt-2">
            @csrf
            <input type="hidden" name="qty" value="1">
            <button type="submit" class="w-full bg-blue-600 text-white rounded px-3 py-1.5 mt-1 hover:bg-blue-700 transition">Tambah ke Keranjang</button>
          </form>
        </div>
      </div>
    @empty
      <div class="col-span-4 text-center text-slate-500">Belum ada produk.</div>
    @endforelse
  </div>

  <div class="mt-6">{{ $products->links() }}</div>
</div>
@endsection

@push('scripts')
<script>
function showToast(msg) {
  let toast = document.createElement('div');
  toast.textContent = msg;
  toast.className = 'fixed top-6 right-6 z-50 bg-blue-700 text-white px-4 py-2 rounded shadow-lg animate-fade-in-up';
  document.body.appendChild(toast);
  setTimeout(() => { toast.classList.add('opacity-0'); }, 1200);
  setTimeout(() => { toast.remove(); }, 1700);
}
document.querySelectorAll('.add-to-cart-form').forEach(form => {
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    fetch(this.action, {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': fd.get('_token'),
      },
      body: fd
    })
    .then(res => res.ok ? res.text() : Promise.reject(res))
    .then(() => {
      // Update badge keranjang
      let badge = document.querySelector('a[title="Keranjang"] span');
      if (badge) {
        badge.textContent = parseInt(badge.textContent || '0') + 1;
        badge.classList.add('animate-bounce');
        setTimeout(() => badge.classList.remove('animate-bounce'), 700);
      }
      showToast('Produk berhasil masuk keranjang!');
    })
    .catch(() => showToast('Gagal menambah ke keranjang.'));
  });
});
</script>
<style>
@keyframes fade-in-up {
  0% { opacity: 0; transform: translateY(20px); }
  100% { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
  animation: fade-in-up 0.4s cubic-bezier(.4,0,.2,1);
  transition: opacity 0.4s;
}
</style>
@endpush


