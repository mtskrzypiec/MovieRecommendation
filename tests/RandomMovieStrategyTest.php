<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use MovieRecommendation\Strategy\RandomStrategy;
use Tests\Traits\ImportMoviesTrait;

class RandomMovieStrategyTest extends TestCase
{
    use ImportMoviesTrait;

    public function testAre3MovesReturned(): void
    {
        //arrange
        $SUT = new RandomStrategy();

        //act
        $filteredMovies = $SUT->getRecommendations($this->movies);

        //assert
        $this->assertCount(
            RandomStrategy::FILTERED_MOVIES_COUNT,
            $filteredMovies,
            "Expected 3 movies to be returned, but got " . count($filteredMovies) . " movies."
        );
    }

    public function testReturnsDifferentResultsOnMultipleCalls(): void
    {
        //arrange
        $SUT = new RandomStrategy();

        //act
        $firstResult = $SUT->getRecommendations($this->movies);
        $secondResult = $SUT->getRecommendations($this->movies);

        //assert
        $this->assertNotSame(
            $firstResult,
            $secondResult,
            "The results are the same on multiple calls, but they should be different."
        );
    }
}
