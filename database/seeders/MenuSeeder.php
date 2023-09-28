<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_lists')->insert([
            [
            'title' => "Подбор педагогических рецептов",
            'content' => "Педагогические ситуации и их решения:
            по предмету
            по классу
            по уровню образования
            по структуре занятия
            по категориям обучающихся",
            'image' => "https://www.ispring.ru/ispring_content/content/images/products/ispring-market/home/ru/market-top-image-v2.webp",
            ],
            [
            'title' => "Авторские рецепты",
            'content' => "Педагогические методики
            Педагогические технологии
            Педагогические разработки
            Комплекты наглядных материалов",
            'image' => "https://www.ispring.ru/ispring_content/content/images/products/ispring-market/home/ru/market-top-image-v2.webp",
            ],
            [
            'title' => "Блюда из ресторанов «MICHELIN»",
            'content' => "Интервью
            Мастер-классы
            Открытые уроки лауреатов и победителей конкурсов, опытных учителей",
            'image' => "https://www.ispring.ru/ispring_content/content/images/products/ispring-market/home/ru/market-top-image-v2.webp",
            ]
        ]);
    }
}
