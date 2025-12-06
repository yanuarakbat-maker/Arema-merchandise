@extends('admin.layout')

@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Produk</h2>

@if ($errors->any())
  <div class="mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded">
    <ul class="list-disc pl-5">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="bg-white rounded shadow p-4 space-y-4">
  @csrf
  <input type="hidden" name="_method" value="PUT">
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Nama</label>
    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-3 py-2" required>
  </div>
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Kategori</label>
    <select name="category_id" class="w-full border rounded px-3 py-2" required>
      @foreach($categories as $category)
        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id)==$category->id)>{{ $category->name }}</option>
      @endforeach
    </select>
  </div>
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Deskripsi</label>
    <textarea name="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description', $product->description) }}</textarea>
  </div>
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Deskripsi Singkat (untuk popup)</label>
    <input type="text" name="deskripsi_singkat" value="{{ old('deskripsi_singkat', $product->deskripsi_singkat) }}" class="w-full border rounded px-3 py-2" maxlength="255">
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1 text-slate-700">Produk Unggulan?</label>
      <input type="hidden" name="is_featured" value="0">
      <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured))>
      <span class="text-sm text-slate-500">Tampilkan di beranda</span>
    </div>
    <div>
      <label class="block text-sm font-medium mb-1 text-slate-700">Stok</label>
      <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border rounded px-3 py-2" min="0" required>
    </div>
    <div>
      <label class="block text-sm font-medium mb-1 text-slate-700">Harga (Rp)</label>
      <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border rounded px-3 py-2" min="0" required>
    </div>
    <div>
      <label class="block text-sm font-medium mb-1 text-slate-700">Gambar Produk (bisa lebih dari satu)</label>
      <input type="file" name="images[]" accept="image/*" class="w-full border rounded px-3 py-2" multiple>
      <div class="flex flex-wrap gap-2 mt-2">
        @foreach($product->images as $img)
          <div class="relative group">
            <img src="{{ asset('storage/'.$img->image_path) }}" class="h-16 rounded border">
            <form action="{{ route('admin.products.deleteImage', [$product->id, $img->id]) }}" method="POST" class="absolute top-0 right-0 hidden group-hover:block">
              @csrf
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="bg-red-600 text-white rounded-full px-2 py-0.5 text-xs">&times;</button>
            </form>
          </div>
        @endforeach
      </div>
      <div id="preview" class="flex flex-wrap gap-2 mt-2"></div>
    </div>
  </div>
  @push('scripts')
  <script>
    document.querySelector('input[type="file"][name="images[]"]')?.addEventListener('change', function(e) {
      const preview = document.getElementById('preview');
      preview.innerHTML = '';
      Array.from(this.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(ev) {
          const img = document.createElement('img');
          img.src = ev.target.result;
          img.className = 'h-16 rounded border';
          preview.appendChild(img);
        };
        reader.readAsDataURL(file);
      });
    });
  </script>
  @endpush
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Size Chart Dewasa (boleh HTML/tabel/gambar)</label>
    <textarea name="size_chart_dewasa" class="w-full border rounded px-3 py-2" rows="6">{{ old('size_chart_dewasa', $product->size_chart_dewasa) }}</textarea>
    <div class="text-xs text-slate-500">Contoh: tabel HTML, gambar, atau teks biasa.</div>
  </div>
  <div>
    <label class="block text-sm font-medium mb-1 text-slate-700">Size Chart Anak-anak (boleh HTML/tabel/gambar)</label>
    <textarea name="size_chart_anak" class="w-full border rounded px-3 py-2" rows="6">{{ old('size_chart_anak', $product->size_chart_anak) }}</textarea>
    <div class="text-xs text-slate-500">Contoh: tabel HTML, gambar, atau teks biasa.</div>
  </div>
  <div class="flex gap-2">
    <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded border">Batal</a>
    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white">Update</button>
  </div>
</form>
@endsection


