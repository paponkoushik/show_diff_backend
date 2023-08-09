<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\DocumentVersion;
use App\Models\User;
use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentUser>
 */
class DocumentUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::query()->take(500)->pluck('id')->toArray();

        $documentIds = Document::query()->take(500)->pluck('id')->toArray();

//        $documentId = fake()->randomElement($documentIds);
//        $documentVersion = DocumentVersion::query()->whereIn('document_id', $documentIds)->pluck('version', 'document_id')->toArray();
//
        $version = Version::query()->pluck('id')->toArray();
        return [
            'document_id' => fake()->randomElement($documentIds),
            'user_id' => fake()->randomElement($userIds),
            'last_viewed_version' => fake()->randomElement($version),
        ];
    }
}
