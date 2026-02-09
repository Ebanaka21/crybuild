<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создаем тестовых пользователей
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Администратор',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Иван Петров',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
            ]
        );

        // Запускаем все seeders в правильном порядке
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            BannerSeeder::class,
            PromotionSeeder::class,
        ]);

        $this->command->info('✓ База данных успешно заполнена!');
        $this->command->info('✓ Тестовые пользователи:');
        $this->command->info('  - Email: admin@example.com, Пароль: password123');
        $this->command->info('  - Email: user@example.com, Пароль: password123');
    }
}
