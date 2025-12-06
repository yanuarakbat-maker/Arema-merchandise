@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Berita</h2>

@if ($errors->any())
  <div class="mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="bg-white rounded shadow p-4 space-y-4">
  @csrf
  <input type="hidden" name="_method" value="PUT">
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Judul</label>
    <input type="text" name="title" value="{{ old('title', $news->title) }}" class="w-full border rounded px-3 py-2" required>
  </div>
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Ringkasan (opsional)</label>
    <input type="text" name="excerpt" value="{{ old('excerpt', $news->excerpt) }}" class="w-full border rounded px-3 py-2">
  </div>
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Konten</label>
    <textarea name="body" rows="6" class="w-full border rounded px-3 py-2" required>{{ old('body', $news->body) }}</textarea>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1 text-slate-700">Tanggal Publikasi</label>
      <input type="datetime-local" name="published_at" value="{{ old('published_at', optional($news->published_at)->format('Y-m-d\\TH:i')) }}" class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1 text-slate-700">Gambar</label>
      <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
      @if($news->image_path)
        <img src="{{ asset('storage/'.$news->image_path) }}" alt="{{ $news->title }}" class="h-16 mt-2">
      @endif
    </div>
  </div>
  <div class="flex gap-2">
    <a href="{{ route('admin.news.index') }}" class="px-4 py-2 rounded border">Batal</a>
    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white">Update</button>
  </div>
</form>
@endsection


