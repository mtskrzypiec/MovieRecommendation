<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use MovieRecommendation\Strategy\MoviesStartingWithWAndEvenLengthStrategy;
use Tests\Traits\ImportMoviesTrait;

class MoviesStartingWithWAndEvenLengthStrategyTest extends TestCase
{
    use ImportMoviesTrait;

    public function testReturnsOnlyMoviesStartingWithWAndEvenLength(): void
    {
        //arrange
        $SUT = new MoviesStartingWithWAndEvenLengthStrategy();

        //act
        $filteredMovies = $SUT->getRecommendations($this->movies);

        //assert
        foreach ($filteredMovies as $movie) {
            $this->assertStringStartsWith(
                "W",
                $movie,
                "Movie '$movie' does not start with 'W'."
            );
            $this->assertEquals(
                0,
                strlen($movie) % 2,
                "Movie '$movie' does not have an even length."
            );
        }
    }

    public function testReturnsEmptyArrayIfNoMatchingMovies(): void
    {
        //arrange
        $movies = ["Batman", "Superman", "Joker"];
        $SUT = new MoviesStartingWithWAndEvenLengthStrategy();

        //act
        $filteredMovies = $SUT->getRecommendations($movies);

        //assert
        $this->assertEmpty(
            $filteredMovies,
            "The filtered movies array is not empty when no movies match the criteria."
        );
    }
}
