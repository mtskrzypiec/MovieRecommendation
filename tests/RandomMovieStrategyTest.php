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
        $filteredMovies = $SUT->getRecommendations(self::$movies);

        //assert
        $this->assertCount(3, $filteredMovies);
    }

    public function testReturnsDifferentResultsOnMultipleCalls(): void
    {
        //arrange
        $SUT = new RandomStrategy();

        //act
        $firstResult = $SUT->getRecommendations(self::$movies);
        $secondResult = $SUT->getRecommendations(self::$movies);

        //assert
        $this->assertNotSame($firstResult, $secondResult);
    }
}
