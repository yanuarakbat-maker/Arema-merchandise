@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative bg-blue-900 text-white min-h-[350px] flex items-center justify-center overflow-hidden">
  <div class="absolute inset-0">
    @if(isset($headerImage) && $headerImage && $headerImage->image_path)
      <img src="{{ asset('storage/'.$headerImage->image_path) }}" alt="Header" class="w-full h-full object-cover opacity-60">
    @else
      <img src="{{ asset('img/arema-hero.jpg') }}" alt="Arema Hero" class="w-full h-full object-cover opacity-60">
    @endif
    <div class="absolute inset-0 bg-blue-900/80"></div>
  </div>
  <div class="relative z-10 max-w-6xl mx-auto px-4 py-20 flex flex-col items-center text-center">
    <h1 class="text-3xl md:text-5xl font-bold drop-shadow">Arema Official Store Merchandise</h1>
    <p class="mt-3 text-blue-100 max-w-2xl">Dapatkan merchandise resmi Arema FC. Dukung tim kebanggaan dengan produk original berkualitas.</p>
    <div class="mt-6">
      <a href="/products" class="bg-white text-blue-700 px-5 py-2 rounded font-semibold shadow hover:bg-blue-100 transition">Lihat Produk</a>
    </div>
  </div>
</section>

<!-- Tentang Toko -->
<section class="max-w-6xl mx-auto px-4 py-12">
  <h2 class="text-xl font-semibold mb-4">Tentang Toko</h2>
  <p class="text-slate-600">Arema Official Store menyediakan berbagai merchandise resmi Arema FC, mulai dari jersey, kaos, aksesoris, dan lain-lain.</p>
</section>

<!-- Berita Terbaru -->
<section class="max-w-6xl mx-auto px-4 pb-12">
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-semibold">Berita Terbaru</h2>
    <a href="{{ url('/news') }}" class="text-sm text-blue-700 hover:underline">Lihat semua</a>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
    @forelse($latestNews as $item)
      <a href="{{ route('news.show', $item->slug) }}" class="group bg-white rounded-lg shadow-sm ring-1 ring-slate-200 overflow-hidden hover:shadow-md transition flex flex-col">
        <div class="aspect-video bg-slate-100 overflow-hidden">
          @if($item->image_path)
            <img src="{{ asset('storage/'.$item->image_path) }}" class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform" alt="{{ $item->title }}">
          @endif
        </div>
        <div class="p-3 flex-1 flex flex-col">
          <div class="text-xs text-slate-500">{{ $item->published_at ? $item->published_at->format('d M Y') : '' }}</div>
          <div class="mt-1 font-medium text-slate-800 line-clamp-2">{{ $item->title }}</div>
          @if($item->excerpt)
            <div class="text-sm text-slate-600 line-clamp-2 mt-1">{{ $item->excerpt }}</div>
          @endif
        </div>
      </a>
    @empty
      <div class="text-slate-500">Belum ada berita.</div>
    @endforelse
  </div>
</section>


<!-- Klasemen Liga -->
@if(isset($standings) && count($standings))
<section class="max-w-3xl mx-auto px-4 pb-12">
  <h2 class="text-xl font-semibold mb-4 text-center">Klasemen BRI SUPER LEAGUE 2025-26</h2>
  <div class="overflow-x-auto">
    <table class="min-w-full border text-sm">
      <thead class="bg-slate-800 text-white">
        <tr>
          <th class="px-2 py-1">POS</th>
          <th class="px-2 py-1">KLUB</th>
          <th class="px-2 py-1">Poin</th>
          <th class="px-2 py-1">Menang</th>
          <th class="px-2 py-1">Seri</th>
          <th class="px-2 py-1">Kalah</th>
          <th class="px-2 py-1">Goal</th>
          <th class="px-2 py-1">+/-</th>
        </tr>
      </thead>
      <tbody>
        @foreach($standings as $row)
        <tr class="{{ $row->highlight ? 'bg-blue-700 text-white' : '' }}">
          <td class="px-2 py-1 text-center">{{ $row->pos }}</td>
          <td class="px-2 py-1 flex items-center gap-2">
            @if($row->logo)
              <img src="{{ asset('storage/'.$row->logo) }}" alt="logo" class="w-6 h-6 inline">
            @endif
            <span>{{ $row->club }}</span>
          </td>
          <td class="px-2 py-1 text-center font-bold">{{ $row->poin }}</td>
          <td class="px-2 py-1 text-center">{{ $row->menang }}</td>
          <td class="px-2 py-1 text-center">{{ $row->seri }}</td>
          <td class="px-2 py-1 text-center">{{ $row->kalah }}</td>
          <td class="px-2 py-1 text-center">{{ $row->goal }}</td>
          <td class="px-2 py-1 text-center">{{ $row->selisih }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>
@endif

<!-- Produk Unggulan -->
<section class="max-w-6xl mx-auto px-4 pb-16">
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-semibold">Produk Unggulan</h2>
    <a href="/products" class="text-sm text-blue-700 hover:underline">Lihat semua</a>
  </div>
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
    @forelse($featuredProducts as $product)
      <div class="group bg-white rounded-lg shadow-sm ring-1 ring-slate-200 overflow-hidden hover:shadow-md hover:-translate-y-0.5 transition-all flex flex-col">
        <div class="aspect-[4/5] bg-slate-100 overflow-hidden">
          @php
            $mainImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
          @endphp
          @if($mainImage)
            <img src="{{ asset('storage/'.$mainImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform">
          @elseif($product->image_path)
            <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform">
          @else
            <div class="w-full h-full flex items-center justify-center text-slate-400 text-sm">No Image</div>
          @endif
        </div>
        <div class="p-3 flex-1 flex flex-col">
          <div class="text-xs inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-blue-50 text-blue-700">
            {{ $product->category->name ?? 'Tanpa Kategori' }}
          </div>
          <div class="mt-2 font-medium text-slate-800 line-clamp-2">{{ $product->name }}</div>
          <div class="mt-1 text-blue-700 font-bold">
            @if(is_numeric($product->price))
              @currency($product->price)
            @else
              {{ $product->price }}
            @endif
          </div>
          <button type="button" class="mt-2 bg-blue-700 text-white px-3 py-1 rounded text-sm font-semibold hover:bg-blue-800 transition w-fit product-detail-btn" data-id="{{ $product->id }}">Lihat Detail</button>
        </div>
      </div>
    @empty
      <div class="col-span-4 text-center text-slate-500">Belum ada produk.</div>
    @endforelse
  </div>

  <!-- Modal Popup Detail Produk (modern, galeri, info, aksi) -->
  <div id="productDetailModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden">
    <div class="bg-white rounded-lg shadow-lg max-w-3xl w-full relative flex flex-col md:flex-row overflow-auto max-h-[90vh]">
      <button id="closeProductModal" class="absolute top-2 right-2 text-slate-500 hover:text-red-500 text-xl z-10">&times;</button>
      <div class="md:w-1/2 w-full p-4 flex flex-col items-center">
        <div id="modalProductGallery" class="w-full flex flex-col items-center">
          <img id="modalProductMainImage" src="" alt="Produk" class="w-full max-h-80 object-contain rounded bg-slate-100 mb-2">
          <div id="modalProductThumbs" class="flex gap-2 mt-2"></div>
        </div>
      </div>
      <div class="md:w-1/2 w-full p-6 flex flex-col">
        <div class="mb-2 text-xs text-blue-700" id="modalProductCategory"></div>
        <div class="mb-2 font-bold text-2xl" id="modalProductName"></div>
        <div class="mb-2 text-blue-700 font-bold text-xl" id="modalProductPrice"></div>
        <div class="mb-2 text-slate-700" id="modalProductShortDesc"></div>
        <div class="mb-2 text-slate-700" id="modalProductDescription"></div>
        <div id="modalProductSizeChart" class="mb-2"></div>
        <div id="modalProductSizeChartDewasa" class="mb-2"></div>
        <div id="modalProductSizeChartAnak" class="mb-2"></div>
        <div class="mb-2 text-xs text-slate-500">Stok: <span id="modalProductStock"></span></div>
        <button class="mt-4 bg-blue-700 text-white px-5 py-2 rounded font-semibold hover:bg-blue-800 transition">Tambah ke Keranjang</button>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('productDetailModal');
    const closeBtn = document.getElementById('closeProductModal');
    const mainImg = document.getElementById('modalProductMainImage');
    const thumbs = document.getElementById('modalProductThumbs');
    function openModal() { modal.classList.remove('hidden'); }
    function closeModal() { modal.classList.add('hidden'); }
    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) {
      if (e.target === modal) closeModal();
    });
    document.querySelectorAll('.product-detail-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        fetch(`/product/${id}/detail`)
          .then(res => res.json())
          .then(data => {
            // Galeri gambar
            if (data.images && data.images.length) {
              mainImg.src = data.images[0];
              thumbs.innerHTML = '';
              data.images.forEach((img, idx) => {
                const thumb = document.createElement('img');
                thumb.src = img;
                thumb.className = 'h-12 w-12 object-cover rounded border cursor-pointer ' + (idx===0 ? 'ring-2 ring-blue-700' : '');
                thumb.onclick = () => {
                  mainImg.src = img;
                  Array.from(thumbs.children).forEach(t => t.classList.remove('ring-2','ring-blue-700'));
                  thumb.classList.add('ring-2','ring-blue-700');
                };
                thumbs.appendChild(thumb);
              });
            } else {
              mainImg.src = data.image_path || '';
              thumbs.innerHTML = '';
            }
            document.getElementById('modalProductName').textContent = data.name;
            document.getElementById('modalProductCategory').textContent = data.category || '';
            document.getElementById('modalProductPrice').textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.price);
            document.getElementById('modalProductShortDesc').textContent = data.deskripsi_singkat || '-';
            document.getElementById('modalProductDescription').textContent = data.description || '-';
            document.getElementById('modalProductStock').textContent = data.stock;
            // Size chart (HTML aman)
            const sizeChart = document.getElementById('modalProductSizeChart');
            const sizeChartDewasa = document.getElementById('modalProductSizeChartDewasa');
            const sizeChartAnak = document.getElementById('modalProductSizeChartAnak');
            sizeChart.innerHTML = '';
            sizeChartDewasa.innerHTML = '';
            sizeChartAnak.innerHTML = '';
            const isKids = /kids|anak/i.test(data.name);
            // Tampilkan size chart dewasa jika ada dan produk bukan kids/anak
            if (data.size_chart_dewasa && !isKids) {
              sizeChartDewasa.innerHTML = '<div class="mt-4"><b>Size Chart Dewasa</b><br>' + data.size_chart_dewasa + '</div>';
            }
            // Tampilkan size chart anak-anak jika ada dan produk kids/anak
            if (data.size_chart_anak && isKids) {
              sizeChartAnak.innerHTML = '<div class="mt-4"><b>Size Chart Anak-anak</b><br>' + data.size_chart_anak + '</div>';
            }
            // Fallback jika hanya size_chart umum
            if (data.size_chart && !data.size_chart_dewasa && !data.size_chart_anak) {
              sizeChart.innerHTML = '<div class="mt-4"><b>Size Chart</b><br>' + data.size_chart + '</div>';
            }
            openModal();
          });
      });
    });
  });
  </script>
  @endpush
</section>

@endsection


