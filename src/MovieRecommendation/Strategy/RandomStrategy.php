<?php

declare(strict_types=1);

namespace src\MovieRecomandation\Strategy;

class RandomStrategy implements RecommendationStrategyInterface
{
    const int MOVIE_FILTERED_COUNT = 3;

    public function getRecommendations(array $movies): array
    {
        shuffle($movies);
        return array_slice($movies, 0, self::MOVIE_FILTERED_COUNT);
    }
}