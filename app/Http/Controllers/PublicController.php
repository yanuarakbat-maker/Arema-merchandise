<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\News;

class PublicController extends Controller
{
    public function home()
    {
        $latestNews = News::orderByDesc('published_at')->latest()->limit(4)->get();
        $headerImage = \App\Models\HeaderImage::first();
        $standings = \App\Models\Standing::orderBy('pos')->get();
        $featuredProducts = \App\Models\Product::with('category','images')->where('is_featured', 1)->latest()->limit(6)->get();
        return view('public.home', compact('latestNews', 'headerImage', 'standings', 'featuredProducts'));
    }

    public function products()
    {
        $products = Product::with('category')->latest()->paginate(12);
        return view('public.products', compact('products'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function newsShow($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('public.news.show', compact('news'));
    }

    public function productDetail($id)
    {
        $product = Product::with(['category', 'images'])->findOrFail($id);
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'category' => $product->category->name ?? null,
            'description' => $product->description,
            'deskripsi_singkat' => $product->deskripsi_singkat,
            'size_chart' => $product->size_chart,
            'size_chart_dewasa' => $product->size_chart_dewasa,
            'size_chart_anak' => $product->size_chart_anak,
            'price' => $product->price,
            'stock' => $product->stock,
            'images' => $product->images->map(fn($img) => asset('storage/'.$img->image_path))->values(),
        ]);
    }

    public function productShow($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('public.products.show', compact('product'));
    }
}


