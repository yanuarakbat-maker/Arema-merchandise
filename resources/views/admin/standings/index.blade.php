@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Klasemen Liga</h1>
        <a href="{{ route('admin.standings.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">Tambah Data</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full border text-sm">
            <thead class="bg-slate-800 text-white">
                <tr>
                    <th class="px-2 py-1">POS</th>
                    <th class="px-2 py-1">Logo</th>
                    <th class="px-2 py-1">Klub</th>
                    <th class="px-2 py-1">Main</th>
                    <th class="px-2 py-1">Menang</th>
                    <th class="px-2 py-1">Seri</th>
                    <th class="px-2 py-1">Kalah</th>
                    <th class="px-2 py-1">Goal</th>
                    <th class="px-2 py-1">+/-</th>
                    <th class="px-2 py-1">Poin</th>
                    <th class="px-2 py-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($standings as $row)
                <tr class="{{ $row->highlight ? 'bg-blue-700 text-white' : '' }}">
                    <td class="px-2 py-1">{{ $row->pos }}</td>
                    <td class="px-2 py-1">
                        @if($row->logo)
                            <img src="{{ asset('storage/'.$row->logo) }}" alt="logo" class="w-8 h-8 inline">
                        @endif
                    </td>
                    <td class="px-2 py-1">{{ $row->club }}</td>
                    <td class="px-2 py-1">{{ $row->main }}</td>
                    <td class="px-2 py-1">{{ $row->menang }}</td>
                    <td class="px-2 py-1">{{ $row->seri }}</td>
                    <td class="px-2 py-1">{{ $row->kalah }}</td>
                    <td class="px-2 py-1">{{ $row->goal }}</td>
                    <td class="px-2 py-1">{{ $row->selisih }}</td>
                    <td class="px-2 py-1 font-bold">{{ $row->poin }}</td>
                    <td class="px-2 py-1">
                        <a href="{{ route('admin.standings.edit', $row->id) }}" class="text-blue-700 hover:underline">Edit</a>
                        <form action="{{ route('admin.standings.destroy', $row->id) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
