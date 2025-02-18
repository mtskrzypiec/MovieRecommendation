<?php

declare(strict_types=1);

namespace MovieRecommendation\Strategy;

use MovieRecommendation\Enum\MovieRecommendationType;

class MultiWordStrategy implements RecommendationStrategyInterface
{
    public function getRecommendations(array $movies): array
    {
        return array_values(array_filter($movies, function ($movie) {
            return str_word_count($movie) > 1;
        }));
    }

    public function getType(): MovieRecommendationType
    {
        return MovieRecommendationType::MULTI_WORD;
    }
}
