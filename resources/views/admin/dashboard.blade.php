@extends('admin.layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bg-white rounded shadow p-4">
        <div class="text-sm text-slate-500">Total Produk</div>
        <div class="text-3xl font-semibold text-slate-800">{{ $totalProducts }}</div>
    </div>
    <div class="bg-white rounded shadow p-4">
        <div class="text-sm text-slate-500">Total Kategori</div>
        <div class="text-3xl font-semibold text-slate-800">{{ $totalCategories }}</div>
    </div>
    <div class="bg-white rounded shadow p-4 md:col-span-2">
        <div class="text-slate-700">Selamat datang di Dashboard Admin Arema Official Store.</div>
    </div>
</div>
@endsection


