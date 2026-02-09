<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Bosch',
                'slug' => 'bosch',
                'description' => 'Немецкий производитель электроинструмента и бытовой техники',
                'logo_url' => 'https://images.unsplash.com/photo-1572981779307-38b8cabb2407?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Makita',
                'slug' => 'makita',
                'description' => 'Японский производитель профессионального электроинструмента',
                'logo_url' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Dewalt',
                'slug' => 'dewalt',
                'description' => 'Американский бренд профессионального электроинструмента',
                'logo_url' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Stanley',
                'slug' => 'stanley',
                'description' => 'Американский производитель ручного инструмента',
                'logo_url' => 'https://images.unsplash.com/photo-1530124566582-a618bc2615dc?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Knauf',
                'slug' => 'knauf',
                'description' => 'Немецкий производитель строительных материалов',
                'logo_url' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Ceresit',
                'slug' => 'ceresit',
                'description' => 'Бренд строительных смесей и материалов',
                'logo_url' => 'https://images.unsplash.com/photo-1581858726788-75bc0f6a952d?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Tikkurila',
                'slug' => 'tikkurila',
                'description' => 'Финский производитель красок и лакокрасочных материалов',
                'logo_url' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Dulux',
                'slug' => 'dulux',
                'description' => 'Британский бренд красок и декоративных покрытий',
                'logo_url' => 'https://images.unsplash.com/photo-1513467535987-fd81bc7d62f8?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Grohe',
                'slug' => 'grohe',
                'description' => 'Немецкий производитель сантехники и смесителей',
                'logo_url' => 'https://images.unsplash.com/photo-1585421514738-01798e348b17?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Hansgrohe',
                'slug' => 'hansgrohe',
                'description' => 'Немецкий производитель премиальной сантехники',
                'logo_url' => 'https://images.unsplash.com/photo-1620626011761-996317b8d101?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Roca',
                'slug' => 'roca',
                'description' => 'Испанский производитель сантехники',
                'logo_url' => 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Villeroy & Boch',
                'slug' => 'villeroy-boch',
                'description' => 'Немецкий производитель премиальной сантехники',
                'logo_url' => 'https://images.unsplash.com/photo-1604709177225-055f99402ea3?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Schneider Electric',
                'slug' => 'schneider-electric',
                'description' => 'Французский производитель электротехнического оборудования',
                'logo_url' => 'https://images.unsplash.com/photo-1621905251918-48416bd8575a?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'ABB',
                'slug' => 'abb',
                'description' => 'Швейцарско-шведский производитель электротехники',
                'logo_url' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Legrand',
                'slug' => 'legrand',
                'description' => 'Французский производитель электромонтажных изделий',
                'logo_url' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'IKEA',
                'slug' => 'ikea',
                'description' => 'Шведский бренд мебели и товаров для дома',
                'logo_url' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Hettich',
                'slug' => 'hettich',
                'description' => 'Немецкий производитель фурнитуры для мебели',
                'logo_url' => 'https://images.unsplash.com/photo-1581539250439-c96689b516dd?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Blum',
                'slug' => 'blum',
                'description' => 'Австрийский производитель мебельной фурнитуры',
                'logo_url' => 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Gardena',
                'slug' => 'gardena',
                'description' => 'Немецкий производитель садового инструмента',
                'logo_url' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
            [
                'name' => 'Fiskars',
                'slug' => 'fiskars',
                'description' => 'Финский производитель садового инструмента',
                'logo_url' => 'https://images.unsplash.com/photo-1617576683096-00fc8eecb3af?w=200&h=200&fit=crop',
                'is_active' => true,
            ],
        ];

        foreach ($brands as $brandData) {
            try {
                // Скачиваем лого если есть URL
                if (isset($brandData['logo_url'])) {
                    $logoUrl = $brandData['logo_url'];
                    $logoPath = $this->downloadImage($logoUrl, 'brands', $brandData['slug']);
                    unset($brandData['logo_url']);
                    $brandData['logo'] = $logoPath;
                }

                Brand::firstOrCreate(
                    ['slug' => $brandData['slug']],
                    $brandData
                );
            } catch (\Exception $e) {
                $this->command->warn("Ошибка при создании бренда '{$brandData['slug']}': " . $e->getMessage());
            }
        }
    }

    private function downloadImage($url, $folder, $filename)
    {
        try {
            $response = Http::timeout(10)->get($url);

            if ($response->successful()) {
                $extension = 'jpg';
                $path = "{$folder}/{$filename}.{$extension}";
                Storage::disk('public')->put($path, $response->body());
                return $path;
            }
        } catch (\Exception $e) {
            $this->command->warn("Не удалось скачать изображение: {$e->getMessage()}");
        }

        return null;
    }
}
