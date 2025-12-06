@extends('layouts.public')

@section('content')
<section class="bg-blue-900 text-white">
  <div class="max-w-6xl mx-auto px-4 py-14 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
    <div>
      <h1 class="text-3xl md:text-4xl font-bold">Tentang Arema Official Store</h1>
      <p class="mt-3 text-blue-100">Toko resmi merchandise Arema FC. Kami menghadirkan produk original berkualitas untuk Aremania di mana pun berada.</p>
    </div>
    <div class="justify-self-end hidden md:block">
      <img src="{{ asset('img/download.jpg') }}" alt="Arema" class="h-24 w-24 md:h-28 md:w-28">
    </div>
  </div>
 </section>

 <section class="max-w-6xl mx-auto px-4 py-12">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    <div class="bg-white rounded-lg shadow-sm ring-1 ring-slate-200 p-5">
      <div class="text-sm text-slate-500">Misi</div>
      <div class="mt-1 font-semibold text-slate-800">Dukungan untuk Tim</div>
      <p class="mt-2 text-slate-600">Sebagai kanal resmi, setiap pembelian turut mendukung Arema FC berkembang lebih baik.</p>
    </div>
    <div class="bg-white rounded-lg shadow-sm ring-1 ring-slate-200 p-5">
      <div class="text-sm text-slate-500">Kualitas</div>
      <div class="mt-1 font-semibold text-slate-800">Produk Original</div>
      <p class="mt-2 text-slate-600">Kami memastikan material berkualitas dan desain autentik khas Singo Edan.</p>
    </div>
    <div class="bg-white rounded-lg shadow-sm ring-1 ring-slate-200 p-5">
      <div class="text-sm text-slate-500">Komunitas</div>
      <div class="mt-1 font-semibold text-slate-800">Untuk Aremania</div>
      <p class="mt-2 text-slate-600">Menghubungkan fans melalui merchandise yang membanggakan identitas Malang.</p>
    </div>
  </div>

  <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow-sm ring-1 ring-slate-200 p-6">
      <div class="font-semibold text-slate-800">Lokasi Toko</div>
      <p class="mt-2 text-slate-600">Malang, Jawa Timur</p>
    </div>
    <div class="bg-white rounded-lg shadow-sm ring-1 ring-slate-200 p-6">
      <div class="font-semibold text-slate-800">Kontak</div>
      <p class="mt-2 text-slate-600">Email: store@aremafc.com</p>
      <p class="text-slate-600">Instagram: @aremafcofficial</p>
    </div>
  </div>
 </section>
@endsection


