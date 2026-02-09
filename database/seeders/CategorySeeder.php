<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Основные категории
        $categories = [
            [
                'name' => 'Строительные материалы',
                'slug' => 'stroitelnye-materialy',
                'description' => 'Все для строительства и ремонта',
                'order' => 1,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Бетон и раствор',
                        'slug' => 'beton-i-rastvor',
                        'description' => 'Готовые смеси и сухие строительные смеси',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Кирпич и блоки',
                        'slug' => 'kirpich-i-bloki',
                        'description' => 'Керамический, силикатный кирпич, газобетонные блоки',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Пиломатериалы',
                        'slug' => 'pilomaterialy',
                        'description' => 'Доска, брус, фанера, ОСБ',
                        'order' => 3,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Изоляционные материалы',
                        'slug' => 'izolyatsionnye-materialy',
                        'description' => 'Утеплители, пароизоляция, гидроизоляция',
                        'order' => 4,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Кровельные материалы',
                        'slug' => 'krovelnye-materialy',
                        'description' => 'Черепица, рубероид, профнастил',
                        'order' => 5,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name' => 'Инструменты',
                'slug' => 'instrumenty',
                'description' => 'Ручной и электроинструмент',
                'order' => 2,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Электроинструмент',
                        'slug' => 'elektroinstrument',
                        'description' => 'Дрели, шуруповерты, пилы, перфораторы',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Ручной инструмент',
                        'slug' => 'ruchnoy-instrument',
                        'description' => 'Молотки, отвертки, ключи, ножовки',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Измерительный инструмент',
                        'slug' => 'izmeritelnyy-instrument',
                        'description' => 'Рулетки, уровни, лазерные дальномеры',
                        'order' => 3,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Садовый инструмент',
                        'slug' => 'sadovyy-instrument',
                        'description' => 'Лопаты, грабли, секаторы, косы',
                        'order' => 4,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name' => 'Отделочные материалы',
                'slug' => 'otdelochnye-materialy',
                'description' => 'Обои, краски, напольные покрытия',
                'order' => 3,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Краски и лаки',
                        'slug' => 'kraski-i-laki',
                        'description' => 'Интерьерные и фасадные краски, лаки, грунтовки',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Обои',
                        'slug' => 'oboi',
                        'description' => 'Бумажные, виниловые, флизелиновые обои',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Напольные покрытия',
                        'slug' => 'napolnye-pokrytiya',
                        'description' => 'Ламинат, паркет, линолеум, плитка',
                        'order' => 3,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Плитка и керамогранит',
                        'slug' => 'plitka-i-keramogranit',
                        'description' => 'Настенная и напольная плитка',
                        'order' => 4,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name' => 'Сантехника',
                'slug' => 'santekhnika',
                'description' => 'Ванны, раковины, смесители, унитазы',
                'order' => 4,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Ванны и душевые кабины',
                        'slug' => 'vanny-i-dushevye-kabiny',
                        'description' => 'Акриловые и чугунные ванны, душевые кабины',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Смесители',
                        'slug' => 'smesiteli',
                        'description' => 'Смесители для кухни и ванной',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Унитазы и биде',
                        'slug' => 'unitazy-i-bide',
                        'description' => 'Подвесные и напольные унитазы, инсталляции',
                        'order' => 3,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Раковины и пьедесталы',
                        'slug' => 'rakoviny-i-pedestaly',
                        'description' => 'Раковины разных размеров и форм',
                        'order' => 4,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name' => 'Электрика',
                'slug' => 'elektrika',
                'description' => 'Провода, розетки, выключатели, освещение',
                'order' => 5,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Кабель и провод',
                        'slug' => 'kabel-i-provod',
                        'description' => 'Электрические кабели и провода',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Розетки и выключатели',
                        'slug' => 'rozetki-i-vyklyuchateli',
                        'description' => 'Механизмы и рамки для розеток и выключателей',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Освещение',
                        'slug' => 'osveshchenie',
                        'description' => 'Лампы, светильники, люстры',
                        'order' => 3,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Автоматика и щиты',
                        'slug' => 'avtomatika-i-shchity',
                        'description' => 'Автоматические выключатели, УЗО, электрощиты',
                        'order' => 4,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name' => 'Сад и огород',
                'slug' => 'sad-i-ogorod',
                'description' => 'Все для сада, огорода и дачи',
                'order' => 6,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Садовая техника',
                        'slug' => 'sadovaya-tekhnika',
                        'description' => 'Газонокосилки, культиваторы, триммеры',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Семена и рассада',
                        'slug' => 'semena-i-rassada',
                        'description' => 'Семена овощей, цветов, рассада',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Удобрения и грунты',
                        'slug' => 'udobreniya-i-grunty',
                        'description' => 'Минеральные и органические удобрения, грунты',
                        'order' => 3,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Садовые декор',
                        'slug' => 'sadovyy-dekor',
                        'description' => 'Садовые фигуры, фонтаны, уличное освещение',
                        'order' => 4,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name' => 'Двери и окна',
                'slug' => 'dveri-i-okna',
                'description' => 'Межкомнатные и входные двери, окна',
                'order' => 7,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Межкомнатные двери',
                        'slug' => 'mezhkomnatnye-dveri',
                        'description' => 'Двери из массива, МДФ, стекла',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Входные двери',
                        'slug' => 'vhodnye-dveri',
                        'description' => 'Металлические и деревянные входные двери',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Окна ПВХ',
                        'slug' => 'okna-pvh',
                        'description' => 'Пластиковые окна и балконные двери',
                        'order' => 3,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Фурнитура для дверей',
                        'slug' => 'furnitura-dlya-dverey',
                        'description' => 'Ручки, замки, петли, доводчики',
                        'order' => 4,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name' => 'Кухня',
                'slug' => 'kukhnya',
                'description' => 'Мебель для кухни, бытовая техника',
                'order' => 8,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Кухонные гарнитуры',
                        'slug' => 'kuhonnye-garnitury',
                        'description' => 'Готовые и модульные кухни',
                        'order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Мойки и смесители',
                        'slug' => 'moyki-i-smesiteli',
                        'description' => 'Кухонные мойки и смесители',
                        'order' => 2,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Бытовая техника',
                        'slug' => 'bytovaya-tekhnika',
                        'description' => 'Плиты, духовки, холодильники, посудомойки',
                        'order' => 3,
                        'is_active' => true,
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            try {
                $children = $categoryData['children'] ?? null;
                unset($categoryData['children']);

                // Используем firstOrCreate для избежания дублей
                $category = Category::firstOrCreate(
                    ['slug' => $categoryData['slug']],
                    $categoryData
                );

                if ($children && $category->wasRecentlyCreated) {
                    foreach ($children as $childData) {
                        try {
                            $childData['parent_id'] = $category->id;
                            Category::firstOrCreate(
                                ['slug' => $childData['slug']],
                                $childData
                            );
                        } catch (\Exception $e) {
                            $this->command->warn("Ошибка при создании подкатегории '{$childData['slug']}': " . $e->getMessage());
                        }
                    }
                }
            } catch (\Exception $e) {
                $this->command->warn("Ошибка при создании категории '{$categoryData['slug']}': " . $e->getMessage());
            }
        }
    }
}
