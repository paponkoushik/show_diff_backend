<?php

namespace Database\Factories;

use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $version = Version::query()->pluck('id')->toArray();
        return [
            'title' => fake()->text(20),
            'current_version' => fake()->randomElement($version),
            'status' => fake()->randomElement(['active' ,'inactive']),
        ];
    }
}
