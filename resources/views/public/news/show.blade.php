@extends('layouts.public')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
  <a href="{{ route('home') }}" class="text-slate-500 hover:text-slate-800">← Kembali</a>
  <h1 class="mt-2 text-3xl font-bold">{{ $news->title }}</h1>
  <div class="text-slate-500 text-sm mt-1">{{ $news->published_at ? $news->published_at->format('d M Y') : '' }}</div>
  @if($news->image_path)
    <img src="{{ asset('storage/'.$news->image_path) }}" alt="{{ $news->title }}" class="mt-4 rounded">
  @endif
  <div class="prose prose-slate mt-4 max-w-none">{!! nl2br(e($news->body)) !!}</div>
</div>
@endsection


