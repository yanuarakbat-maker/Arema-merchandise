@extends('layouts.public')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-2xl font-bold mb-4">Pesanan Berhasil Dibuat</h2>
        <div class="mb-4">
            <div class="font-semibold">Kode Pesanan: <span class="text-blue-600">#{{ $order->id }}</span></div>
            <div>Status: <span class="font-semibold capitalize">{{ $order->status }}</span></div>
        </div>
        <div class="mb-4">
            <h3 class="font-semibold mb-2">Detail Pesanan</h3>
            <ul class="mb-2">
                @foreach($order->items as $item)
                    <li class="flex justify-between border-b py-1">
                        <span>{{ $item->product_name }} x{{ $item->quantity }}</span>
                        <span>Rp{{ number_format($item->price * $item->quantity,0,',','.') }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="flex justify-between font-bold">
                <span>Total</span>
                <span>Rp{{ number_format($order->total,0,',','.') }}</span>
            </div>
        </div>
        <div class="mb-4">
            <h3 class="font-semibold mb-2">Instruksi Pembayaran</h3>
            @if($order->payment_method === 'transfer')
                <div>Silakan transfer ke rekening <span class="font-semibold">BCA 1234567890 a.n. Arema Store</span> sejumlah <span class="font-semibold">Rp{{ number_format($order->total,0,',','.') }}</span> dan konfirmasi ke admin.</div>
            @elseif($order->payment_method === 'qris')
                <div>Scan QRIS berikut untuk pembayaran:<br><img src="{{ asset('img/qris.png') }}" alt="QRIS" class="h-32 mt-2"></div>
            @elseif($order->payment_method === 'cod')
                <div>Pembayaran akan dilakukan di tempat saat pesanan diterima.</div>
            @endif
        </div>
        <div class="text-right">
            <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
