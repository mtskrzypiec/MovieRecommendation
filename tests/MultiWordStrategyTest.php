<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use src\MovieRecomandation\Strategy\MultiWordStrategy;
use Tests\Traits\ImportMoviesTrait;

class MultiWordStrategyTest extends TestCase
{
    use ImportMoviesTrait;

    public function testReturnsOnlyMoviesWithMultipleWords(): void
    {
        //arrange
        $SUT = new MultiWordStrategy();

        //act
        $filteredMovies = $SUT->getRecommendations(self::$movies);

        //assert
        foreach ($filteredMovies as $movie) {
            $this->assertGreaterThan(1, str_word_count($movie));
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