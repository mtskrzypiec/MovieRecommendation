<?php

declare(strict_types=1);

namespace MovieRecommendation\Strategy;

use MovieRecommendation\Enum\MovieRecommendationType;

class MultiWordStrategy implements RecommendationStrategyInterface
{
    public function getRecommendations(array $movies): array
    {
        return array_values(array_filter($movies, function ($movie) {
            return $this->countWords($movie) > 1;
        }));
    }

    public function getType(): MovieRecommendationType
    {
        return MovieRecommendationType::MULTI_WORD;
    }

    private function countWords(string $movie): int
    {
        $movie = preg_replace('/[^\p{L}\p{N}\s]/u', '', $movie);
        $words = preg_split('/\s+/', trim($movie));

        return count($words);
    }
}
