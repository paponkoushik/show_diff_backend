<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentVersion>
 */
class DocumentVersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_id' => mt_rand(1, 1200),
            'version' => fake()->randomElement([1, 2]),
            'body_content' => $this->getBodyContent(),
            'tags_content' => $this->tagsContent()
        ];
    }

    public function getBodyContent(): object
    {
        $content = (object) [
            "introduction"=> "<ul><li>Federal Government's superannuation reforms in the 2020.\t</li></ul>",
            "facts" => "<ul><li>Federal Government's superannuation reforms in the 2020.\t</li></ul>",
            "summary" => "<ul><li>Federal Government's superannuation reforms in the 2020.\t</li></ul>"
        ];

        $texts = fake()->paragraphs(rand(2, 6));

        foreach ($texts as $text) {
            $content->introduction .= "<p>{$text}</p>";
            $content->facts .= "<p>{$text}</p>";
            $content->summary .= "<p>{$text}</p>";
        }
        return $content;
    }

    public function tagsContent(): string
    {
        $content = "<ul><li>Federal Government's superannuation reforms in the 2020.\t</li></ul>";

        $texts = fake()->paragraphs(rand(1,1));

        foreach ($texts as $text) {
            $content .= "<p>{$text}</p>";
        }
        return $content;
    }
}
