@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Ubah Status Pesanan #{{ $order->id }}</h2>
<div class="bg-white rounded shadow p-6 mb-6">
  <form method="POST" action="{{ route('admin.orders.update', $order) }}">
    @csrf
    @method('PUT')
    <div class="mb-4">
      <label class="block font-medium mb-1">Status Pesanan</label>
      <select name="status" class="w-full border rounded px-3 py-2" required>
        <option value="pending" @if($order->status=='pending') selected @endif>Pending</option>
        <option value="dibayar" @if($order->status=='dibayar') selected @endif>Dibayar</option>
        <option value="selesai" @if($order->status=='selesai') selected @endif>Selesai</option>
        <option value="batal" @if($order->status=='batal') selected @endif>Batal</option>
      </select>
    </div>
    <div class="text-right">
      <button class="px-4 py-2 bg-blue-600 text-white rounded">Update Status</button>
      <a href="{{ route('admin.orders.show', $order) }}" class="ml-2 px-4 py-2 bg-slate-200 rounded">Batal</a>
    </div>
  </form>
</div>
@endsection
