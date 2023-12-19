<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class Languages extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            [
                'locale' => 'ua',
                'short' => 'укр',
                'title' => 'Українська',
                'position' => 1,
                'public' => 1
            ],
            [
                'locale' => 'ru',
                'short' => 'рус',
                'title' => 'Русский',
                'position' => 2,
                'public' => 1
            ],
            [
                'locale' => 'en',
                'short' => 'eng',
                'title' => 'English',
                'position' => 3,
                'public' => 0
            ],
        ];

        foreach($languages as $language)
            \DB::table('languages')->insert($language);
        
    }
}
