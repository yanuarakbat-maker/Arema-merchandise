@extends('layouts.public')

@section('content')
<section class="bg-blue-900 text-white">
  <div class="max-w-6xl mx-auto px-4 py-14 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
    <div>
      <h1 class="text-3xl md:text-4xl font-bold">Hubungi Kami</h1>
      <p class="mt-3 text-blue-100">Ada pertanyaan tentang merchandise atau stok? Tim kami siap membantu.</p>
    </div>
    <div class="justify-self-end hidden md:block">
      <img src="{{ asset('img/download.jpg') }}" alt="Arema" class="h-24 w-24 md:h-28 md:w-28">
    </div>
  </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-12">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    <div class="bg-white rounded-lg shadow-sm ring-1 ring-slate-200 p-5">
      <div class="text-sm text-slate-500">Email</div>
      <a href="mailto:store@aremafc.com" class="mt-1 block font-semibold text-slate-800">store@aremafc.com</a>
    </div>
    <div class="bg-white rounded-lg shadow-sm ring-1 ring-slate-200 p-5">
      <div class="text-sm text-slate-500">Instagram</div>
      <a href="https://instagram.com/aremafcofficial" target="_blank" rel="noreferrer" class="mt-1 block font-semibold text-slate-800">@aremafcofficial</a>
    </div>
    <div class="bg-white rounded-lg shadow-sm ring-1 ring-slate-200 p-5">
      <div class="text-sm text-slate-500">Alamat</div>
      <div class="mt-1 font-semibold text-slate-800">Malang, Jawa Timur</div>
    </div>
  </div>

  <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow-sm ring-1 ring-slate-200 p-6">
      <div class="font-semibold text-slate-800">Kirim Pesan</div>
      <p class="mt-1 text-slate-500 text-sm">Form ini contoh tampilan. Silakan hubungi kami via email/IG.</p>
      <form class="mt-4 space-y-4" onsubmit="event.preventDefault(); alert('Ini hanya contoh tampilan. Hubungi via email/IG.');">
        <div>
          <label class="block text-sm mb-1 text-slate-600">Nama</label>
          <input type="text" class="w-full border rounded px-3 py-2" placeholder="Nama Anda">
        </div>
        <div>
          <label class="block text-sm mb-1 text-slate-600">Email</label>
          <input type="email" class="w-full border rounded px-3 py-2" placeholder="email@contoh.com">
        </div>
        <div>
          <label class="block text-sm mb-1 text-slate-600">Pesan</label>
          <textarea rows="4" class="w-full border rounded px-3 py-2" placeholder="Tulis pesan..."></textarea>
        </div>
        <button class="bg-blue-700 hover:bg-blue-800 text-white rounded px-4 py-2">Kirim</button>
      </form>
    </div>
    <div class="bg-white rounded-lg shadow-sm ring-1 ring-slate-200 p-6">
      <div class="font-semibold text-slate-800">Jam Operasional</div>
      <ul class="mt-3 text-slate-600 text-sm space-y-1">
        <li>Senin - Jumat: 09.00 - 17.00</li>
        <li>Sabtu: 10.00 - 15.00</li>
        <li>Minggu: Tutup</li>
      </ul>
    </div>
  </div>
</section>
@endsection


