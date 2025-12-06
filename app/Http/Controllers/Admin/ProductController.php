<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;

class ProductController extends Controller
{

        // Hapus produk
        public function destroy(Product $product)
        {
            // Hapus semua gambar terkait
            foreach ($product->images as $img) {
                \Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }
            // Hapus produk
            $product->delete();
            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
        }
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'category_id' => ['required','exists:categories,id'],
            'description' => ['nullable','string'],
            'deskripsi_singkat' => ['nullable','string','max:255'],
            'size_chart' => ['nullable','string'],
            'size_chart_dewasa' => ['nullable','string'],
            'size_chart_anak' => ['nullable','string'],
            'stock' => ['required','integer','min:0'],
            'price' => ['required','integer','min:0'],
            'images.*' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            // is_featured tidak perlu divalidasi boolean, cukup nullable
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->input('is_featured', 0) == 1 ? 1 : 0;

        $product = Product::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $img) {
                $path = $img->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => $i === 0, // gambar pertama jadi utama
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        \Log::info('ProductController@update called', ['request' => $request->all(), 'product_id' => $product->id]);
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'category_id' => ['required','exists:categories,id'],
            'description' => ['nullable','string'],
            'deskripsi_singkat' => ['nullable','string','max:255'],
            'size_chart' => ['nullable','string'],
            'size_chart_dewasa' => ['nullable','string'],
            'size_chart_anak' => ['nullable','string'],
            'stock' => ['required','integer','min:0'],
            'price' => ['required','integer','min:0'],
            'images.*' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        // Pastikan slug unik kecuali untuk produk ini sendiri
        $slugExists = Product::where('slug', $validated['slug'])->where('id', '!=', $product->id)->exists();
        if ($slugExists) {
            return back()->withErrors(['name' => 'Nama produk menghasilkan slug yang sudah digunakan produk lain. Silakan gunakan nama berbeda.'])->withInput();
        }
        $validated['is_featured'] = $request->input('is_featured', 0) == 1 ? 1 : 0;

        $product->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui');
    }


    // Hapus gambar produk (untuk galeri multi gambar)
    public function deleteImage($productId, $imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return back()->with('success', 'Gambar produk dihapus.');
    }
}




