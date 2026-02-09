<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;
use App\Models\Product;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        $promotions = [
            [
                'name' => 'Летняя распродажа',
                'slug' => 'summer-sale',
                'description' => 'Скидки до 50% на все строительные материалы в летний период',
                'image' => 'promotions/summer-sale.jpg',
                'discount_type' => 'percent',
                'discount_value' => 20.00,
                'start_date' => '2026-06-01',
                'end_date' => '2026-08-31',
                'is_active' => true,
            ],
            [
                'name' => 'Скидка на электроинструмент',
                'slug' => 'power-tools-discount',
                'description' => 'Скидки на весь электроинструмент от ведущих брендов',
                'image' => 'promotions/power-tools.jpg',
                'discount_type' => 'percent',
                'discount_value' => 15.00,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'is_active' => true,
            ],
            [
                'name' => 'Скидка на сантехнику',
                'slug' => 'sanitary-discount',
                'description' => 'Выгодные предложения на сантехнику для ванной комнаты',
                'image' => 'promotions/sanitary.jpg',
                'discount_type' => 'percent',
                'discount_value' => 10.00,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'is_active' => true,
            ],
            [
                'name' => 'Фиксированная скидка на первый заказ',
                'slug' => 'first-order-discount',
                'description' => 'Скидка 1000 рублей на первый заказ',
                'image' => 'promotions/first-order.jpg',
                'discount_type' => 'fixed',
                'discount_value' => 1000.00,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'is_active' => true,
            ],
        ];

        foreach ($promotions as $promotionData) {
            try {
                // Используем firstOrCreate чтобы избежать дублей
                $promotion = Promotion::firstOrCreate(
                    ['slug' => $promotionData['slug']],
                    $promotionData
                );

                // Добавляем товары к акциям (без привязки если товаров нет)
                if ($promotion->wasRecentlyCreated) {
                    $productIds = [];

                    if ($promotion->slug === 'power-tools-discount') {
                        $tools = Product::whereHas('category', function ($q) {
                            $q->where('slug', 'elektroinstrument');
                        })->pluck('id');
                        $productIds = $tools->toArray();
                    } elseif ($promotion->slug === 'sanitary-discount') {
                        $sanitary = Product::whereHas('category', function ($q) {
                            $q->where('slug', 'like', '%santekhnika%');
                        })->pluck('id');
                        $productIds = $sanitary->toArray();
                    } elseif ($promotion->slug === 'summer-sale') {
                        $all = Product::limit(10)->pluck('id');
                        $productIds = $all->toArray();
                    }

                    // Присоединяем товары если они есть
                    if (!empty($productIds)) {
                        $promotion->products()->attach($productIds);
                    }
                }
            } catch (\Exception $e) {
                // Логируем ошибку но продолжаем выполнение
                $this->command->warn("Ошибка при создании акции '{$promotionData['slug']}': " . $e->getMessage());
            }
        }
    }
}
