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
            $this->assertGreaterThanOrEqual(
                2,
                $this->countWords($movie),
                "Movie '$movie' does not have the required number of words"
            );
        }
    }

    public function testReturnsEmptyArrayIfNotMatchingMovies(): void
    {
        //arrange
        $SUT = new MultiWordStrategy();

        //act
        $filteredMovies = $SUT->getRecommendations(["Incepcja", "Django", "Nędznicy"]);

        //assert
        $this->assertEmpty(
            $filteredMovies,
            "Expected an empty array, but got movies: " . implode(', ', $filteredMovies)
        );
    }
}
