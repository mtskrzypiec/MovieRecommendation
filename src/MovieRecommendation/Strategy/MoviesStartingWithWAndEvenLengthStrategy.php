<?php

declare(strict_types=1);

namespace MovieRecommendation\Strategy;

use MovieRecommendation\Enum\MovieRecommendationType;

class MoviesStartingWithWAndEvenLengthStrategy implements RecommendationStrategyInterface
{
    public function getRecommendations(array $movies): array
    {
        return array_values(array_filter($movies, function ($movie) {
            return str_starts_with($movie, 'W') && strlen($movie) % 2 === 0;
        }));
    }

    public function getType(): MovieRecommendationType
    {
        return MovieRecommendationType::W_EVEN;
    }
}
