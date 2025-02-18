<?php

declare(strict_types=1);

namespace MovieRecommendation\Strategy;

use MovieRecommendation\Enum\MovieRecommendationType;

class RandomStrategy implements RecommendationStrategyInterface
{
    public const int FILTERED_MOVIES_COUNT = 3;

    public function getRecommendations(array $movies): array
    {
        shuffle($movies);
        return array_slice($movies, 0, self::FILTERED_MOVIES_COUNT);
    }

    public function getType(): MovieRecommendationType
    {
        return MovieRecommendationType::RANDOM;
    }
}
