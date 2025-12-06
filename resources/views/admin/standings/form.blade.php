@extends('admin.layout')

@section('content')
<div class="max-w-lg mx-auto p-4 bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-4 text-slate-800">Tambah/Edit Klasemen</h1>
    <form method="POST" action="{{ isset($standing) ? route('admin.standings.update', $standing->id) : route('admin.standings.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($standing))
            <input type="hidden" name="_method" value="PUT">
        @endif
        <div class="mb-2">
            <label class="block text-slate-700">POS</label>
            <input type="number" name="pos" class="form-input w-full" value="{{ old('pos', $standing->pos ?? '') }}" required>
        </div>
        <div class="mb-2">
            <label class="block text-slate-700">Klub</label>
            <input type="text" name="club" class="form-input w-full" value="{{ old('club', $standing->club ?? '') }}" required>
        </div>
        <div class="mb-2">
            <label class="block text-slate-700">Logo (url/file)</label>
            <input type="file" name="logo" class="form-input w-full">
            @if(isset($standing) && $standing->logo)
                <img src="{{ asset('storage/'.$standing->logo) }}" class="w-12 h-12 mt-1">
            @endif
        </div>
        <div class="mb-2">
            <label class="block text-slate-700">Main</label>
            <input type="number" name="main" class="form-input w-full" value="{{ old('main', $standing->main ?? 0) }}">
        </div>
        <div class="mb-2">
            <label class="block text-slate-700">Menang</label>
            <input type="number" name="menang" class="form-input w-full" value="{{ old('menang', $standing->menang ?? 0) }}">
        </div>
        <div class="mb-2">
            <label class="block text-slate-700">Seri</label>
            <input type="number" name="seri" class="form-input w-full" value="{{ old('seri', $standing->seri ?? 0) }}">
        </div>
        <div class="mb-2">
            <label class="block text-slate-700">Kalah</label>
            <input type="number" name="kalah" class="form-input w-full" value="{{ old('kalah', $standing->kalah ?? 0) }}">
        </div>
        <div class="mb-2">
            <label class="block text-slate-700">Goal</label>
            <input type="number" name="goal" class="form-input w-full" value="{{ old('goal', $standing->goal ?? 0) }}">
        </div>
        <div class="mb-2">
            <label class="block text-slate-700">+/-</label>
            <input type="number" name="selisih" class="form-input w-full" value="{{ old('selisih', $standing->selisih ?? 0) }}">
        </div>
        <div class="mb-2">
            <label class="block text-slate-700">Poin</label>
            <input type="number" name="poin" class="form-input w-full" value="{{ old('poin', $standing->poin ?? 0) }}">
        </div>
        <div class="mb-2">
            <label class="block text-slate-700">Urutan</label>
            <input type="number" name="urutan" class="form-input w-full" value="{{ old('urutan', $standing->urutan ?? 0) }}">
        </div>
        <div class="mb-2">
            <label class="inline-flex items-center text-slate-700">
                <input type="checkbox" name="highlight" value="1" {{ old('highlight', $standing->highlight ?? false) ? 'checked' : '' }} class="dark:bg-slate-900"> Highlight (Arema FC)
            </label>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">Simpan</button>
            <a href="{{ route('admin.standings.index') }}" class="ml-2 text-slate-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
