@extends('admin.layout')

@section('content')
<div class="container mx-auto max-w-lg py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Header Image</h1>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.header.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1 font-medium">Header Image</label>
            @if($header && $header->image_path)
                <img src="{{ asset('storage/'.$header->image_path) }}" alt="Header" class="mb-2 w-full max-h-48 object-cover rounded">
            @endif
            <input type="file" name="image" class="block w-full border rounded p-2">
            @error('image')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
