<?php

declare(strict_types=1);

namespace MovieRecommendation;

use MovieRecommendation\Enum\MovieRecommendationType;
use MovieRecommendation\Exception\StrategyWasNotRegistered;
use MovieRecommendation\Strategy\RecommendationStrategyInterface;

class MovieRecommender
{
    /** @var array<string, RecommendationStrategyInterface> */
    private array $strategies = [];

    /**
     * @param iterable<RecommendationStrategyInterface> $strategies
     * @param string[] $movies
     */
    public function __construct(iterable $strategies, private array $movies)
    {
        foreach ($strategies as $strategy) {
            $this->strategies[$strategy->getType()->value] = $strategy;
        }
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
