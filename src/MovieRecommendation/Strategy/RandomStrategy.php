<?php

declare(strict_types=1);

namespace MovieRecommendation\Strategy;

class RandomStrategy implements RecommendationStrategyInterface
{
    const int FILTERED_MOVIES_COUNT = 3;

    public function getRecommendations(array $movies): array
    {
        shuffle($movies);
        return array_slice($movies, 0, self::FILTERED_MOVIES_COUNT);
    }
}
