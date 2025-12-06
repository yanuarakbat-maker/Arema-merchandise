@extends('layouts.public')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row gap-8">
        <div class="flex-shrink-0 w-full md:w-1/2">
            @if($product->image_path)
                <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="w-full rounded shadow">
            @else
                <div class="w-full h-64 flex items-center justify-center bg-slate-100 text-slate-400">No Image</div>
            @endif
        </div>
        <div class="flex-1">
            <div class="text-xs inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 mb-2">
                {{ $product->category->name ?? 'Tanpa Kategori' }}
            </div>
            <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
            <div class="text-blue-700 font-bold text-xl mb-4">@currency($product->price)</div>
            <div class="mb-4 text-slate-700">{!! nl2br(e($product->description)) !!}</div>
            <div class="mb-2 text-xs text-slate-500">Stok: {{ $product->stock }}</div>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-block mt-4 bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">Edit di Admin</a>
        </div>
    </div>
</div>
@endsection
