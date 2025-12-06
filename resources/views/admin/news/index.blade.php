@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="text-xl font-semibold">Berita</h2>
  <a href="{{ route('admin.news.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Tambah</a>
</div>

@if(session('success'))
  <div class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded">{{ session('success') }}</div>
@endif

<div class="bg-white rounded shadow overflow-x-auto">
  <table class="min-w-full text-sm">
    <thead class="bg-slate-50">
      <tr>
        <th class="text-left p-3 text-slate-500">Judul</th>
        <th class="text-left p-3 text-slate-500">Dipublikasikan</th>
        <th class="p-3 text-slate-500">Gambar</th>
        <th class="p-3 text-slate-500">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($news as $item)
        <tr class="border-t">
          <td class="p-3 text-slate-800">{{ $item->title }}</td>
          <td class="p-3 text-slate-500">{{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}</td>
          <td class="p-3">
            @if($item->image_path)
              <img class="h-12" src="{{ asset('storage/'.$item->image_path) }}" alt="{{ $item->title }}">
            @else
              <span class="text-slate-400">-</span>
            @endif
          </td>
          <td class="p-3 text-right space-x-2">
            <a href="{{ route('admin.news.edit', $item) }}" class="text-blue-600">Edit</a>
            <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini?')">
              @csrf
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="text-red-600">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="p-4 text-center text-slate-500">Belum ada berita.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $news->links() }}</div>
@endsection


