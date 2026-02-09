<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Летняя распродажа',
                'description' => 'Скидки до 50% на все строительные материалы',
                'image' => 'banners/summer-sale.jpg',
                'link' => '/promotions/summer-sale',
                'position' => 'main_slider',
                'order' => 1,
                'start_date' => '2026-06-01',
                'end_date' => '2026-08-31',
                'is_active' => true,
            ],
            [
                'title' => 'Новое поступление инструментов',
                'description' => 'Актуальные новинки от ведущих брендов',
                'image' => 'banners/new-tools.jpg',
                'link' => '/catalog/elektroinstrument',
                'position' => 'main_slider',
                'order' => 2,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'is_active' => true,
            ],
            [
                'title' => 'Скидки на сантехнику',
                'description' => 'Выгодные предложения для ванной комнаты',
                'image' => 'banners/sanitary-sale.jpg',
                'link' => '/catalog/santekhnika',
                'position' => 'main_slider',
                'order' => 3,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'is_active' => true,
            ],
            [
                'title' => 'Всё для сада',
                'description' => 'Подготовьтесь к летнему сезону',
                'image' => 'banners/garden.jpg',
                'link' => '/catalog/sad-i-ogorod',
                'position' => 'category_top',
                'order' => 1,
                'start_date' => '2026-03-01',
                'end_date' => '2026-09-30',
                'is_active' => true,
            ],
            [
                'title' => 'Бесплатная доставка',
                'description' => 'При заказе от 10 000 ₽',
                'image' => 'banners/free-delivery.jpg',
                'link' => null,
                'position' => 'sidebar',
                'order' => 1,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'is_active' => true,
            ],
            [
                'title' => 'Кредит на покупку',
                'description' => 'Рассрочка 0% на 6 месяцев',
                'image' => 'banners/credit.jpg',
                'link' => null,
                'position' => 'sidebar',
                'order' => 2,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            try {
                Banner::firstOrCreate(
                    ['title' => $banner['title'], 'position' => $banner['position']],
                    $banner
                );
            } catch (\Exception $e) {
                $this->command->warn("Ошибка при создании баннера '{$banner['title']}': " . $e->getMessage());
            }
        }
    }
}
