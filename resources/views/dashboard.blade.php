<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-2xl font-bold mb-6">Riwayat Pesanan Saya</h3>
            <form method="GET" action="{{ url('/dashboard') }}" class="mb-8 flex flex-col sm:flex-row gap-3 items-center">
                <input type="text" name="q" class="border rounded px-3 py-2 w-64" placeholder="Masukkan Email atau Nomor Order" value="{{ request('q') }}">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">Cek Pesanan</button>
            </form>
            @php
                $orders = collect();
                $q = request('q');
                if ($q) {
                    $orders = \App\Models\Order::where('email', $q)
                        ->orWhere('id', $q)
                        ->orderByDesc('created_at')
                        ->with(['items.product.images'])
                        ->get();
                }
            @endphp
            @if($q && $orders->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 animate-fade-in-up">
                    <img src='https://cdn.jsdelivr.net/gh/stevenjoezhang/lottie-animated-icons@main/empty-box.json' alt="empty" class="w-40 h-40 mb-4" style="filter: grayscale(1);">
                    <div class="text-gray-500 text-lg">Pesanan tidak ditemukan.<br>Pastikan email atau nomor order benar.</div>
                </div>
            @elseif($orders->isNotEmpty())
                <div class="grid gap-6">
                @foreach($orders as $order)
                    <div class="bg-white shadow-md rounded-lg p-5 flex flex-col sm:flex-row sm:items-center gap-4 hover:shadow-xl transition-all animate-fade-in-up">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-semibold text-blue-700">#{{ $order->id }}</span>
                                <span class="text-xs text-gray-400">{{ $order->created_at->format('d M Y H:i') }}</span>
                                <span class="ml-2 px-2 py-0.5 rounded-full text-xs font-semibold
                                    @if($order->status=='pending') bg-yellow-100 text-yellow-700
                                    @elseif($order->status=='dibayar') bg-blue-100 text-blue-700
                                    @elseif($order->status=='selesai') bg-green-100 text-green-700
                                    @elseif($order->status=='batal') bg-red-100 text-red-700
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="text-gray-700 mb-1">Total: <b>Rp{{ number_format($order->total,0,',','.') }}</b></div>
                            <div class="text-gray-500 text-sm mb-2">Metode: {{ strtoupper($order->payment_method) }}</div>
                            <div class="text-gray-600 text-sm flex flex-wrap gap-3">
                                @foreach($order->items as $item)
                                    @php
                                        $img = null;
                                        if ($item->product) {
                                            $mainImg = $item->product->images->where('is_primary', true)->first() ?? $item->product->images->first();
                                            $img = $mainImg ? asset('storage/'.$mainImg->image_path) : ($item->product->image_path ? asset('storage/'.$item->product->image_path) : null);
                                        }
                                    @endphp
                                    <span class="flex items-center gap-2 bg-slate-50 rounded px-2 py-1 shadow-sm">
                                        @if($img)
                                            <img src="{{ $img }}" alt="{{ $item->product_name }}" class="w-10 h-10 object-cover rounded border">
                                        @else
                                            <span class="w-10 h-10 flex items-center justify-center bg-slate-200 rounded border text-xs text-slate-400">No Image</span>
                                        @endif
                                        <span>{{ $item->product_name }} x{{ $item->quantity }}</span>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('order.show', $order) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach
                </div>
            @endif
        </div>
    </div>
    <style>
    @keyframes fade-in-up {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fade-in-up 0.5s cubic-bezier(.4,0,.2,1); }
    </style>
</x-app-layout>
