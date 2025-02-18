<?php

declare(strict_types=1);

namespace MovieRecommendation\Strategy;

use MovieRecommendation\Enum\MovieRecommendationType;

interface RecommendationStrategyInterface
{
    public function getType(): MovieRecommendationType;
    public function getRecommendations(array $movies): array;
}
