<?php

declare(strict_types=1);

namespace src\MovieRecomandation;

use src\MovieRecomandation\Enum\MovieRecommendationType;
use src\MovieRecomandation\Strategy\RecommendationStrategyInterface;

readonly class MovieRecommender
{
    public function __construct(
        /**
         * @var RecommendationStrategyInterface[]
         */
        private array $strategies,
        /**
         * @var string[]
         */
        private array $movies,
    ) {
    }

    public function getRecommendations(MovieRecommendationType $type): array
    {
        return $this->strategies[$type->value]->getRecommendations($this->movies);
    }
}
