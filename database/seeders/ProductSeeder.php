<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('slug');
        $brands = Brand::all()->keyBy('slug');

        $products = [
            // Электроинструмент
            [
                'name' => 'Дрель ударная Bosch GSB 550',
                'sku' => 'BOS-001',
                'description' => 'Мощная ударная дрель для домашнего использования. Идеально подходит для сверления и заворачивания шурупов.',
                'price' => 5990.00,
                'old_price' => 6990.00,
                'category_slug' => 'elektroinstrument',
                'brand_slug' => 'bosch',
                'stock' => 25,
                'unit' => 'шт.',
                'rating' => 4.5,
                'reviews_count' => 12,
                'is_featured' => true,
                'is_new' => false,
                'features' => [
                    'Мощность' => '550 Вт',
                    'Макс. диаметр сверления (дерево)' => '30 мм',
                    'Макс. диаметр сверления (металл)' => '13 мм',
                    'Число оборотов' => '0-3000 об/мин',
                    'Вес' => '1.7 кг',
                ],
            ],
            [
                'name' => 'Шуруповерт Makita DF033D',
                'sku' => 'MAK-001',
                'description' => 'Компактный шуруповерт с аккумулятором. Отличный выбор для домашних работ.',
                'price' => 4490.00,
                'category_slug' => 'elektroinstrument',
                'brand_slug' => 'makita',
                'stock' => 18,
                'unit' => 'шт.',
                'rating' => 4.7,
                'reviews_count' => 8,
                'is_featured' => true,
                'is_new' => true,
                'features' => [
                    'Мощность' => '10.8 В',
                    'Макс. крутящий момент' => '30 Нм',
                    'Число скоростей' => '2',
                    'Вес' => '1.0 кг',
                ],
            ],
            [
                'name' => 'Перфоратор Dewalt D25133K',
                'sku' => 'DEW-001',
                'description' => 'Профессиональный перфоратор для тяжелых работ.',
                'price' => 12990.00,
                'category_slug' => 'elektroinstrument',
                'brand_slug' => 'dewalt',
                'stock' => 10,
                'unit' => 'шт.',
                'rating' => 4.8,
                'reviews_count' => 15,
                'is_featured' => false,
                'is_new' => false,
                'features' => [
                    'Мощность' => '800 Вт',
                    'Ударная сила' => '3.2 Дж',
                    'Макс. диаметр сверления (бетон)' => '32 мм',
                    'Вес' => '3.2 кг',
                ],
            ],
            // Ручной инструмент
            [
                'name' => 'Набор отверток Stanley 6 шт.',
                'sku' => 'STA-001',
                'description' => 'Комплект отверток с магнитными наконечниками.',
                'price' => 890.00,
                'category_slug' => 'ruchnoy-instrument',
                'brand_slug' => 'stanley',
                'stock' => 50,
                'unit' => 'компл.',
                'rating' => 4.3,
                'reviews_count' => 22,
                'is_featured' => false,
                'is_new' => false,
                'features' => [
                    'Количество' => '6 шт.',
                    'Тип наконечника' => 'PH, SL',
                    'Материал рукоятки' => 'Пластик',
                ],
            ],
            [
                'name' => 'Молоток-гвоздодер Stanley FatMax',
                'sku' => 'STA-002',
                'description' => 'Универсальный молоток с гвоздодером.',
                'price' => 1290.00,
                'category_slug' => 'ruchnoy-instrument',
                'brand_slug' => 'stanley',
                'stock' => 35,
                'unit' => 'шт.',
                'rating' => 4.6,
                'reviews_count' => 18,
                'is_featured' => true,
                'is_new' => false,
                'features' => [
                    'Вес' => '570 г',
                    'Материал головки' => 'Сталь',
                    'Длина' => '330 мм',
                ],
            ],
            // Строительные материалы
            [
                'name' => 'Штукатурка Knauf Rotband 25 кг',
                'sku' => 'KNA-001',
                'description' => 'Высококачественная гипсовая штукатурка для внутренних работ.',
                'price' => 450.00,
                'category_slug' => 'beton-i-rastvor',
                'brand_slug' => 'knauf',
                'stock' => 100,
                'unit' => 'меш.',
                'rating' => 4.9,
                'reviews_count' => 45,
                'is_featured' => true,
                'is_new' => false,
                'features' => [
                    'Вес' => '25 кг',
                    'Тип' => 'Гипсовая',
                    'Расход' => '8-10 кг/м²',
                ],
            ],
            [
                'name' => 'Клей для плитки Ceresit CM11 25 кг',
                'sku' => 'CER-001',
                'description' => 'Универсальный клей для керамической плитки.',
                'price' => 520.00,
                'category_slug' => 'beton-i-rastvor',
                'brand_slug' => 'ceresit',
                'stock' => 80,
                'unit' => 'меш.',
                'rating' => 4.7,
                'reviews_count' => 32,
                'is_featured' => false,
                'is_new' => false,
                'features' => [
                    'Вес' => '25 кг',
                    'Тип' => 'Цементный',
                    'Расход' => '2-4 кг/м²',
                ],
            ],
            [
                'name' => 'Газобетонный блок D500 600x250x200 мм',
                'sku' => 'BLK-001',
                'description' => 'Стеновой блок из газобетона для строительства.',
                'price' => 180.00,
                'category_slug' => 'kirpich-i-bloki',
                'brand_slug' => null,
                'stock' => 500,
                'unit' => 'шт.',
                'rating' => 4.5,
                'reviews_count' => 28,
                'is_featured' => false,
                'is_new' => false,
                'features' => [
                    'Размер' => '600x250x200 мм',
                    'Плотность' => 'D500',
                    'Класс прочности' => 'B2.5',
                ],
            ],
            // Отделочные материалы
            [
                'name' => 'Краска интерьерная Tikkurila Harmony 2.7 л',
                'sku' => 'TIK-001',
                'description' => 'Матовая краска для стен и потолков.',
                'price' => 1890.00,
                'category_slug' => 'kraski-i-laki',
                'brand_slug' => 'tikkurila',
                'stock' => 40,
                'unit' => 'банка',
                'rating' => 4.8,
                'reviews_count' => 56,
                'is_featured' => true,
                'is_new' => false,
                'features' => [
                    'Объем' => '2.7 л',
                    'Тип' => 'Водоэмульсионная',
                    'Степень блеска' => 'Матовая',
                    'Расход' => '6-8 м²/л',
                ],
            ],
            [
                'name' => 'Обои виниловые Dulux 10.05 м',
                'sku' => 'DUL-001',
                'description' => 'Виниловые обои с рельефным рисунком.',
                'price' => 1290.00,
                'category_slug' => 'oboi',
                'brand_slug' => 'dulux',
                'stock' => 25,
                'unit' => 'рул.',
                'rating' => 4.4,
                'reviews_count' => 19,
                'is_featured' => false,
                'is_new' => true,
                'features' => [
                    'Ширина' => '53 см',
                    'Длина' => '10.05 м',
                    'Материал' => 'Винил',
                    'Тип поклейки' => 'На флизелиновой основе',
                ],
            ],
            [
                'name' => 'Ламинат Tarkett Oak 1.48 м²',
                'sku' => 'LAM-001',
                'description' => 'Ламинат с имитацией дуба.',
                'price' => 890.00,
                'category_slug' => 'napolnye-pokrytiya',
                'brand_slug' => null,
                'stock' => 60,
                'unit' => 'упак.',
                'rating' => 4.6,
                'reviews_count' => 34,
                'is_featured' => true,
                'is_new' => false,
                'features' => [
                    'Площадь упаковки' => '1.48 м²',
                    'Толщина' => '8 мм',
                    'Класс износостойкости' => '32',
                    'Тип соединения' => 'Замковый',
                ],
            ],
            // Сантехника
            [
                'name' => 'Смеситель для кухни Grohe Eurosmart',
                'sku' => 'GRO-001',
                'description' => 'Кухонный смеситель с выдвижной лейкой.',
                'price' => 8990.00,
                'category_slug' => 'smesiteli',
                'brand_slug' => 'grohe',
                'stock' => 15,
                'unit' => 'шт.',
                'rating' => 4.9,
                'reviews_count' => 27,
                'is_featured' => true,
                'is_new' => false,
                'features' => [
                    'Тип' => 'Однорычажный',
                    'Материал' => 'Латунь',
                    'Высота излива' => '230 мм',
                    'Гарантия' => '5 лет',
                ],
            ],
            [
                'name' => 'Ванна акриловая Roca Victoria 170 см',
                'sku' => 'ROC-001',
                'description' => 'Акриловая ванна классической формы.',
                'price' => 15990.00,
                'category_slug' => 'vanny-i-dushevye-kabiny',
                'brand_slug' => 'roca',
                'stock' => 8,
                'unit' => 'шт.',
                'rating' => 4.7,
                'reviews_count' => 21,
                'is_featured' => false,
                'is_new' => false,
                'features' => [
                    'Длина' => '170 см',
                    'Ширина' => '75 см',
                    'Материал' => 'Акрил',
                    'Цвет' => 'Белый',
                ],
            ],
            [
                'name' => 'Унитаз подвесной Villeroy & Boch Subway 2.0',
                'sku' => 'VIL-001',
                'description' => 'Подвесной унитаз премиум класса.',
                'price' => 24990.00,
                'category_slug' => 'unitazy-i-bide',
                'brand_slug' => 'villeroy-boch',
                'stock' => 5,
                'unit' => 'шт.',
                'rating' => 4.9,
                'reviews_count' => 14,
                'is_featured' => true,
                'is_new' => false,
                'features' => [
                    'Тип' => 'Подвесной',
                    'Материал' => 'Керамика',
                    'Длина' => '540 мм',
                    'Гарантия' => '10 лет',
                ],
            ],
            // Электрика
            [
                'name' => 'Розетка Schneider Electric Sedna',
                'sku' => 'SCH-001',
                'description' => 'Розетка с заземлением.',
                'price' => 290.00,
                'category_slug' => 'rozetki-i-vyklyuchateli',
                'brand_slug' => 'schneider-electric',
                'stock' => 100,
                'unit' => 'шт.',
                'rating' => 4.5,
                'reviews_count' => 67,
                'is_featured' => false,
                'is_new' => false,
                'features' => [
                    'Тип' => 'С заземлением',
                    'Макс. ток' => '16 А',
                    'Макс. напряжение' => '250 В',
                ],
            ],
            [
                'name' => 'Кабель ВВГнг 3х2.5 100 м',
                'sku' => 'KAB-001',
                'description' => 'Медный кабель для проводки.',
                'price' => 8900.00,
                'category_slug' => 'kabel-i-provod',
                'brand_slug' => null,
                'stock' => 30,
                'unit' => 'бухта',
                'rating' => 4.6,
                'reviews_count' => 42,
                'is_featured' => false,
                'is_new' => false,
                'features' => [
                    'Сечение' => '3х2.5 мм²',
                    'Длина' => '100 м',
                    'Материал жил' => 'Медь',
                    'Изоляция' => 'ПВХ',
                ],
            ],
            // Сад
            [
                'name' => 'Газонокосилка Gardena PowerMax',
                'sku' => 'GAR-001',
                'description' => 'Бензиновая газонокосилка для больших участков.',
                'price' => 24990.00,
                'category_slug' => 'sadovaya-tekhnika',
                'brand_slug' => 'gardena',
                'stock' => 6,
                'unit' => 'шт.',
                'rating' => 4.7,
                'reviews_count' => 18,
                'is_featured' => true,
                'is_new' => false,
                'features' => [
                    'Тип двигателя' => 'Бензиновый',
                    'Ширина скашивания' => '46 см',
                    'Объем травосборника' => '60 л',
                    'Мощность' => '2.8 кВт',
                ],
            ],
            [
                'name' => 'Секатор Fiskars PowerGear',
                'sku' => 'FIS-001',
                'description' => 'Эргономичный секатор для обрезки веток.',
                'price' => 1890.00,
                'category_slug' => 'sadovyy-instrument',
                'brand_slug' => 'fiskars',
                'stock' => 45,
                'unit' => 'шт.',
                'rating' => 4.8,
                'reviews_count' => 53,
                'is_featured' => false,
                'is_new' => false,
                'features' => [
                    'Тип' => 'Для обрезки веток',
                    'Длина лезвия' => '55 мм',
                    'Материал' => 'Сталь',
                ],
            ],
            // Двери
            [
                'name' => 'Межкомнатная дверь Hettich Style',
                'sku' => 'HET-001',
                'description' => 'Межкомнатная дверь из МДФ с фурнитурой Hettich.',
                'price' => 8990.00,
                'category_slug' => 'mezhkomnatnye-dveri',
                'brand_slug' => 'hettich',
                'stock' => 12,
                'unit' => 'шт.',
                'rating' => 4.5,
                'reviews_count' => 16,
                'is_featured' => false,
                'is_new' => true,
                'features' => [
                    'Размер' => '80х200 см',
                    'Материал' => 'МДФ',
                    'Цвет' => 'Дуб натуральный',
                    'Комплектация' => 'С фурнитурой',
                ],
            ],
            // Кухня
            [
                'name' => 'Кухонный гарнитур IKEA METOD',
                'sku' => 'IKE-001',
                'description' => 'Модульная кухня IKEA с фурнитурой Blum.',
                'price' => 89990.00,
                'category_slug' => 'kuhonnye-garnitury',
                'brand_slug' => 'ikea',
                'stock' => 3,
                'unit' => 'компл.',
                'rating' => 4.6,
                'reviews_count' => 9,
                'is_featured' => true,
                'is_new' => false,
                'features' => [
                    'Размер' => '240х220 см',
                    'Материал фасадов' => 'МДФ',
                    'Фурнитура' => 'Blum',
                    'Цвет' => 'Белый',
                ],
            ],
        ];

        foreach ($products as $productData) {
            try {
                $categorySlug = $productData['category_slug'];
                $brandSlug = $productData['brand_slug'];
                $features = $productData['features'] ?? null;

                unset($productData['category_slug']);
                unset($productData['brand_slug']);
                unset($productData['features']);

                $productData['category_id'] = $categories[$categorySlug]->id ?? null;
                $productData['brand_id'] = $brandSlug ? ($brands[$brandSlug]->id ?? null) : null;
                $productData['features'] = $features ? json_encode($features) : null;

                // Генерируем slug вручную
                $productData['slug'] = Str::slug($productData['name']);

                // Используем firstOrCreate чтобы избежать дублей по SKU
                $product = Product::firstOrCreate(
                    ['sku' => $productData['sku']],
                    $productData
                );

                // Создаем изображение для товара только если это новый товар
                if ($product->wasRecentlyCreated) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => 'products/' . strtolower(str_replace(' ', '-', $product->name)) . '.jpg',
                        'order' => 0,
                        'is_primary' => true,
                    ]);
                }
            } catch (\Exception $e) {
                $this->command->warn("Ошибка при создании товара '{$productData['name']}': " . $e->getMessage());
            }
        }
    }
}
