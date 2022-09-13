<?php

namespace Database\Factories;

use Domain\Category\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
    
    public function definition(): array
    {
        $title = $this->faker->words(nb: 3, asText: true);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->randomHtml(),
            'description' => $this->faker->sentences(nb: 2, asText: true),
            'published' => $this->faker->boolean,
            'parent' => $this->faker->random_int(1, 10),
        ];
    }
}
