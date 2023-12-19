<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Page;
use App\Models\Page_languages;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition()
    {
        return [
            'type' => 'pages',
            'alt_title' => $this->faker->slug,
            'preview' => null,
            'position' => 0,
            'public' => 1,
            'user_id' => 1,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Page $page) {
            // Создаем связанный языковой объект для каждого языка
            Page_languages::factory()->count(2)->create([
                'page_id' => $page->id,
            ]);
        });
    }
}
