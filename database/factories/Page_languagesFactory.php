<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Page_languages;
use App\Models\Page;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Page_languagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Page_languages::class;

    public function definition(): array
    {
        return [
            'language' => $this->faker->randomElement(['ua', 'ru']),
            'menu' => $this->faker->sentence,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'tag_title' => $this->faker->word,
            'description' => $this->faker->paragraph,
        ];
    
    }

    public function configure()
    {
        return $this->afterCreating(function (Page_languages $page_language) {
  
            if($page_language->language == 'ru')
            {
                Page::find($page_language->page_id)->update([
                    'alt_title' => str()->slug($page_language->title)]);
            }
        });
    }
}
