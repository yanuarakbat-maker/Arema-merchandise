@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="text-xl font-semibold">Produk</h2>
  <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Tambah</a>
</div>

@if(session('success'))
  <div class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded">{{ session('success') }}</div>
@endif

<div class="bg-white rounded shadow overflow-x-auto">
  <table class="min-w-full text-sm">
    <thead class="bg-slate-50">
      <tr>
        <th class="text-left p-3 text-slate-500">Produk</th>
        <th class="text-left p-3 text-slate-500">Kategori</th>
        <th class="text-left p-3 text-slate-500">Stok</th>
        <th class="text-left p-3 text-slate-500">Harga</th>
        <th class="p-3 text-slate-500">Gambar</th>
        <th class="p-3 text-slate-500">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($products as $product)
        <tr class="border-t">
          <td class="p-3 text-slate-800">{{ $product->name }}</td>
          <td class="p-3 text-slate-500">{{ $product->category->name ?? '-' }}</td>
          <td class="p-3 text-slate-800">{{ $product->stock }}</td>
          <td class="p-3 text-slate-800">Rp {{ number_format($product->price,0,',','.') }}</td>
          <td class="p-3">
            @php
              $mainImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
            @endphp
            @if($mainImage)
              <img src="{{ asset('storage/'.$mainImage->image_path) }}" alt="{{ $product->name }}" class="h-12">
            @elseif($product->image_path)
              <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="h-12">
            @else
              <span class="text-slate-400">-</span>
            @endif
          </td>
          <td class="p-3 text-right space-x-2">
            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600">Edit</a>
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini?')">
              @csrf
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="text-red-600">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="p-4 text-center text-slate-500">Belum ada produk.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $products->links() }}</div>
@endsection


