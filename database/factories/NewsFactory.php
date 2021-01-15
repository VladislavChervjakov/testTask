<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'image' => $this->faker->image('public/storage/news', 300,
                200, null, false),
            'is_published' => 1,
            'short_text' => $this->faker->text('30'),
            'full_text' => $this->faker->text('100'),
            'created_at' => $this->faker->dateTimeBetween('-3 month',
                '-2 days'),
        ];
    }
}
