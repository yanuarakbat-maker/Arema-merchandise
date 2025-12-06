@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-semibold">Kategori</h2>
    <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Tambah</a>
  </div>

  @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded">{{ session('success') }}</div>
  @endif

  <div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="text-left p-3 text-slate-500">Nama</th>
          <th class="text-left p-3 text-slate-500">Slug</th>
          <th class="p-3 text-slate-500">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categories as $category)
          <tr class="border-t">
            <td class="p-3 text-slate-800">{{ $category->name }}</td>
            <td class="p-3 text-slate-500">{{ $category->slug }}</td>
            <td class="p-3 text-right space-x-2">
              <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600">Edit</a>
              <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="text-red-600">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="p-4 text-center text-slate-500">Belum ada kategori.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $categories->links() }}</div>
@endsection


