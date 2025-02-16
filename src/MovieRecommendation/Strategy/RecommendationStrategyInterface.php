<?php

declare(strict_types=1);

namespace MovieRecommendation\Strategy;

interface RecommendationStrategyInterface
{
    public function getRecommendations(array $movies): array;
}
