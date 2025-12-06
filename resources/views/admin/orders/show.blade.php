@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Detail Pesanan #{{ $order->id }}</h2>
@if(session('success'))
  <div class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded">{{ session('success') }}</div>
@endif
<div class="bg-white rounded shadow p-6 mb-6">
  <div class="mb-2"><b>Nama:</b> {{ $order->name }}</div>
  <div class="mb-2"><b>Email:</b> {{ $order->email }}</div>
  <div class="mb-2"><b>No HP:</b> {{ $order->phone }}</div>
  <div class="mb-2"><b>Alamat:</b> {{ $order->address }}</div>
  <div class="mb-2"><b>Status:</b> <span class="capitalize">{{ $order->status }}</span> <a href="{{ route('admin.orders.edit', $order) }}" class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded">Ubah Status</a></div>
  <div class="mb-2"><b>Metode Pembayaran:</b> {{ strtoupper($order->payment_method) }}</div>
  <div class="mb-2"><b>Tanggal:</b> {{ $order->created_at->format('d M Y H:i') }}</div>
</div>
<div class="bg-white rounded shadow p-6">
  <h3 class="font-semibold mb-2">Item Pesanan</h3>
  <table class="min-w-full text-sm mb-4">
    <thead>
      <tr>
        <th class="text-left p-2">Produk</th>
        <th class="text-left p-2">Harga</th>
        <th class="text-left p-2">Jumlah</th>
        <th class="text-left p-2">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->items as $item)
        <tr>
          <td class="p-2">{{ $item->product_name }}</td>
          <td class="p-2">Rp{{ number_format($item->price,0,',','.') }}</td>
          <td class="p-2">{{ $item->quantity }}</td>
          <td class="p-2">Rp{{ number_format($item->price * $item->quantity,0,',','.') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="text-right font-bold">Total: Rp{{ number_format($order->total,0,',','.') }}</div>
</div>
<a href="{{ route('admin.orders.index') }}" class="mt-6 inline-block px-4 py-2 bg-slate-200 rounded">Kembali</a>
@endsection
