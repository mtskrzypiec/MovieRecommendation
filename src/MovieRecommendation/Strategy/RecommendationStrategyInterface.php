<?php

declare(strict_types=1);

namespace src\MovieRecomandation\Strategy;

interface RecommendationStrategyInterface
{
    public function getRecommendations(array $movies): array;
}