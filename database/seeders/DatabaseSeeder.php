<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\News;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin default
        Admin::query()->firstOrCreate(
            ['email' => 'admin@arema.test'],
            ['name' => 'Admin', 'password' => 'password']
        );

        // Kategori
        $categoryNames = ['Jersey', 'Pakaian', 'Aksesoris'];
        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[$name] = Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        }

        // Produk contoh (5 item)
        $products = [
            ['name' => 'Jersey Home 2025', 'category' => 'Jersey', 'price' => 399000, 'stock' => 25],
            ['name' => 'Jersey Away 2025', 'category' => 'Jersey', 'price' => 399000, 'stock' => 18],
            ['name' => 'Kaos Arema Classic', 'category' => 'Pakaian', 'price' => 149000, 'stock' => 40],
            ['name' => 'Topi Singo Edan', 'category' => 'Aksesoris', 'price' => 99000, 'stock' => 30],
            ['name' => 'Syal Arema FC', 'category' => 'Aksesoris', 'price' => 79000, 'stock' => 50],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'name' => $p['name'],
                    'category_id' => $categories[$p['category']]->id,
                    'description' => 'Produk resmi Arema FC. Kualitas terbaik.',
                    'price' => $p['price'],
                    'stock' => $p['stock'],
                    'image_path' => null,
                ]
            );
        }

        // Seed 5 news
        $newsItems = [
            ['title' => 'Peluncuran Jersey 2025', 'excerpt' => 'Jersey terbaru resmi dirilis.'],
            ['title' => 'Arema FC Menang di Laga Uji Coba', 'excerpt' => 'Kemenangan meyakinkan di Stadion Kanjuruhan.'],
            ['title' => 'Diskon Akhir Tahun di Official Store', 'excerpt' => 'Nikmati promo spesial akhir tahun.'],
            ['title' => 'Kolaborasi Arema x Brand Lokal', 'excerpt' => 'Kolaborasi eksklusif dengan kualitas premium.'],
            ['title' => 'Restock Item Favorit Aremania', 'excerpt' => 'Produk populer kembali tersedia.'],
        ];

        foreach ($newsItems as $i => $n) {
            News::firstOrCreate(
                ['slug' => Str::slug($n['title'])],
                [
                    'title' => $n['title'],
                    'excerpt' => $n['excerpt'],
                    'body' => ($n['excerpt'] ?? 'Berita Arema') . "\n\nSelengkapnya di Arema Official Store.",
                    'image_path' => null,
                    'published_at' => now()->subDays(5 - $i),
                ]
            );
        }
    }
}
