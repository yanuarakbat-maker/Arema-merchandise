@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Daftar Pesanan</h2>
@if(session('success'))
  <div class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded">{{ session('success') }}</div>
@endif
<div class="bg-white rounded shadow overflow-x-auto">
  <table class="min-w-full text-sm">
    <thead class="bg-slate-50">
      <tr>
        <th class="text-left p-3 text-slate-500">ID</th>
        <th class="text-left p-3 text-slate-500">Nama</th>
        <th class="text-left p-3 text-slate-500">Email</th>
        <th class="text-left p-3 text-slate-500">No HP</th>
        <th class="text-left p-3 text-slate-500">Total</th>
        <th class="text-left p-3 text-slate-500">Status</th>
        <th class="text-left p-3 text-slate-500">Tanggal</th>
        <th class="p-3 text-slate-500">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($orders as $order)
        <tr class="border-t">
          <td class="p-3">#{{ $order->id }}</td>
          <td class="p-3">{{ $order->name }}</td>
          <td class="p-3">{{ $order->email }}</td>
          <td class="p-3">{{ $order->phone }}</td>
          <td class="p-3">Rp{{ number_format($order->total,0,',','.') }}</td>
          <td class="p-3 capitalize">{{ $order->status }}</td>
          <td class="p-3">{{ $order->created_at->format('d M Y H:i') }}</td>
          <td class="p-3 text-right">
            <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600">Detail</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="8" class="p-4 text-center text-slate-500">Belum ada pesanan.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
