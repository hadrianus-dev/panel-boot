<?php

namespace Database\Factories;

use App\Models\Church;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChurchFactory extends Factory
{
    protected $model = Church::class;

    public function definition()
    {
        $title = $this->faker->words(nb: 3, asText: true);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->randomHtml(),
            'description' => $this->faker->sentences(nb: 2, asText: true),
            'published' => $this->faker->boolean,
        ];
    }
}
