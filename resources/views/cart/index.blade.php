@extends('layouts.public')

@section('content')
<div class="max-w-3xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-6">Keranjang Belanja</h2>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded">{{ session('error') }}</div>
    @endif
    @if(empty($cart))
        <div class="text-center text-slate-500">Keranjang belanja kosong.</div>
        <a href="{{ route('products') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">Lanjut Belanja</a>
    @else
    <form method="POST" action="{{ route('cart.clear') }}" class="mb-4 text-right">
        @csrf
        <button class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200">Kosongkan Keranjang</button>
    </form>
    <div class="bg-white rounded shadow p-4 mb-6">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="p-2 text-left">Produk</th>
                    <th class="p-2">Harga</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    @php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; @endphp
                    <tr class="border-b">
                        <td class="p-2 flex items-center gap-2">
                            @if($item['image'])
                                <img src="{{ asset('storage/'.$item['image']) }}" class="h-10 w-10 rounded object-cover" alt="{{ $item['name'] }}">
                            @endif
                            <span>{{ $item['name'] }}</span>
                        </td>
                        <td class="p-2">Rp{{ number_format($item['price'],0,',','.') }}</td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('cart.update', $item['id']) }}" class="inline-flex gap-1">
                                @csrf
                                <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="w-14 border rounded px-2 py-1">
                                <button class="px-2 py-1 bg-blue-100 text-blue-600 rounded hover:bg-blue-200">Ubah</button>
                            </form>
                        </td>
                        <td class="p-2">Rp{{ number_format($subtotal,0,',','.') }}</td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                                @csrf
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right mt-4 text-lg font-semibold">Total: Rp{{ number_format($total,0,',','.') }}</div>
    </div>
    <div class="flex justify-between">
        <a href="{{ route('products') }}" class="px-4 py-2 bg-slate-200 rounded">Lanjut Belanja</a>
        <a href="{{ route('checkout.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Checkout</a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Interaktif update subtotal & total jika ingin AJAX penuh (opsional, contoh dasar)
// Untuk update langsung tanpa reload, perlu ubah form update/hapus jadi AJAX juga
// Berikut contoh update badge dan notifikasi saja (karena update qty/hapus masih reload)
function showToast(msg) {
  let toast = document.createElement('div');
  toast.textContent = msg;
  toast.className = 'fixed top-6 right-6 z-50 bg-blue-700 text-white px-4 py-2 rounded shadow-lg animate-fade-in-up';
  document.body.appendChild(toast);
  setTimeout(() => { toast.classList.add('opacity-0'); }, 1200);
  setTimeout(() => { toast.remove(); }, 1700);
}
// Jika ingin update qty/hapus tanpa reload, bisa gunakan fetch+FormData seperti di produk
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
