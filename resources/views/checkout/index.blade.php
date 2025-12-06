@extends('layouts.public')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-6">Checkout</h2>
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded">{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('checkout.process') }}" class="bg-white rounded shadow p-6 space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1 text-slate-700">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1 text-slate-700">No. HP</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1 text-slate-700">Alamat Pengiriman</label>
                <textarea name="address" rows="2" class="w-full border rounded px-3 py-2" required>{{ old('address') }}</textarea>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1 text-slate-700">Metode Pembayaran</label>
            <select name="payment_method" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih --</option>
                <option value="transfer">Transfer Bank</option>
                <option value="qris">QRIS</option>
                <option value="cod">COD (Bayar di Tempat)</option>
            </select>
        </div>
        <div class="bg-slate-50 rounded p-4 mt-4">
            <h3 class="font-semibold mb-2">Ringkasan Pesanan</h3>
            <ul class="mb-2">
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    @php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; @endphp
                    <li class="flex justify-between border-b py-1">
                        <span>{{ $item['name'] }} x{{ $item['qty'] }}</span>
                        <span>Rp{{ number_format($subtotal,0,',','.') }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="flex justify-between font-bold">
                <span>Total</span>
                <span>Rp{{ number_format($total,0,',','.') }}</span>
            </div>
        </div>
        <div class="text-right mt-4">
            <button class="px-6 py-2 bg-blue-600 text-white rounded">Buat Pesanan</button>
        </div>
    </form>
</div>
@endsection
