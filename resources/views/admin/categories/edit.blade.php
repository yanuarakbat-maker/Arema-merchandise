@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Kategori</h2>

@if ($errors->any())
  <div class="mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('admin.categories.update', $category) }}" class="bg-white rounded shadow p-4 space-y-4">
  @csrf
  <input type="hidden" name="_method" value="PUT">
  <div>
    <label class="block text-sm font-medium mb-1">Nama</label>
    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border rounded px-3 py-2" required>
  </div>
    <div class="flex gap-2">
    <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 rounded border">Batal</a>
    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white">Update</button>
  </div>
 </form>
@endsection


