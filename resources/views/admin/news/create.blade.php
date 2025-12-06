@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Tambah Berita</h2>

@if ($errors->any())
  <div class="mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="bg-white rounded shadow p-4 space-y-4">
  @csrf
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Judul</label>
    <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2" required>
  </div>
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Ringkasan (opsional)</label>
    <input type="text" name="excerpt" value="{{ old('excerpt') }}" class="w-full border rounded px-3 py-2">
  </div>
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Konten</label>
    <textarea name="body" rows="6" class="w-full border rounded px-3 py-2" required>{{ old('body') }}</textarea>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1 text-slate-700">Tanggal Publikasi</label>
      <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1 text-slate-700">Gambar</label>
      <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
    </div>
  </div>
  <div class="flex gap-2">
    <a href="{{ route('admin.news.index') }}" class="px-4 py-2 rounded border">Batal</a>
    <button class="px-4 py-2 rounded bg-blue-600 text-white">Simpan</button>
  </div>
</form>
@endsection


