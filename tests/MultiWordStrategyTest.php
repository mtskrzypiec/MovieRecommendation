<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use MovieRecommendation\Strategy\MultiWordStrategy;
use Tests\Traits\ImportMoviesTrait;
use Tests\Traits\WordsTrait;

class MultiWordStrategyTest extends TestCase
{
    use ImportMoviesTrait;
    use WordsTrait;

    public function testReturnsOnlyMoviesWithMultipleWords(): void
    {
        //arrange
        $SUT = new MultiWordStrategy();

        //act
        $filteredMovies = $SUT->getRecommendations($this->movies);

        //assert
        foreach ($filteredMovies as $movie) {
            $this->assertGreaterThanOrEqual(2, $this->countWords($movie));
        }
    }

    public function testReturnsEmptyArrayIfNotMatchingMovies(): void
    {
        //arrange
        $SUT = new MultiWordStrategy();

        //act
        $filteredMovies = $SUT->getRecommendations([]);

        //assert
        $this->assertEmpty($filteredMovies);
    }
}
