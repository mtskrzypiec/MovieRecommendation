<?php

declare(strict_types=1);

namespace MovieRecommendation;

use MovieRecommendation\Enum\MovieRecommendationType;
use MovieRecommendation\Exceptions\StrategyWasNotRegistered;
use MovieRecommendation\Strategy\RecommendationStrategyInterface;

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

    /**
     * @throws StrategyWasNotRegistered
     */
    public function getRecommendations(MovieRecommendationType $type): array
    {
        if (!array_key_exists($type->value, $this->strategies)) {
            throw new StrategyWasNotRegistered($type->value);
        }

        return $this->strategies[$type->value]->getRecommendations($this->movies);
    }
}
