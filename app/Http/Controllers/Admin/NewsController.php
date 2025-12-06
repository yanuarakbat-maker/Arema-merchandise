<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest('published_at')->latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:255'],
            'excerpt' => ['nullable','string','max:255'],
            'body' => ['required','string'],
            'published_at' => ['nullable','date'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $validated['image_path'] = $path;
        }

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita ditambahkan');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        \Log::info('NewsController@update called', ['request' => $request->all(), 'news_id' => $news->id]);
        $validated = $request->validate([
            'title' => ['required','string','max:255'],
            'excerpt' => ['nullable','string','max:255'],
            'body' => ['required','string'],
            'published_at' => ['nullable','date'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $path = $request->file('image')->store('news', 'public');
            $validated['image_path'] = $path;
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita diperbarui');
    }

    public function destroy(News $news)
    {
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Berita dihapus');
    }
}


