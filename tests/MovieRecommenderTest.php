<?php

declare(strict_types=1);

namespace Tests;

use MovieRecommendation\Enum\MovieRecommendationType;
use MovieRecommendation\Exceptions\StrategyWasNotRegistered;
use MovieRecommendation\MovieRecommender;
use MovieRecommendation\Strategy\MoviesStartingWithWAndEvenLengthStrategy;
use MovieRecommendation\Strategy\MultiWordStrategy;
use MovieRecommendation\Strategy\RandomStrategy;
use PHPUnit\Framework\TestCase;
use Tests\Traits\ImportMoviesTrait;

class MovieRecommenderTest extends TestCase
{
    use ImportMoviesTrait;

    private MovieRecommender $SUT;

    public function setUp(): void
    {
        //arrange
        $this->SUT = new MovieRecommender(
            [
                MovieRecommendationType::RANDOM->value => new RandomStrategy(),
                MovieRecommendationType::W_EVEN->value => new MoviesStartingWithWAndEvenLengthStrategy(),
                MovieRecommendationType::MULTI_WORD->value => new MultiWordStrategy(),
            ],
            self::$movies,
        );
    }

    public function testReturnsMoviesFromRandomStrategy(): void
    {
        //act
        $result = $this->SUT->getRecommendations(MovieRecommendationType::RANDOM);

        //assert
        $this->assertCount(3, $result);
    }

    public function testReturnsMoviesFromWEvenStrategy(): void
    {
        //act
        $result = $this->SUT->getRecommendations(MovieRecommendationType::W_EVEN);

        //assert
        foreach ($result as $movie) {
            $this->assertStringStartsWith('W', $movie);
            $this->assertEquals(0, strlen($movie) % 2);
        }
    }

    public function testReturnsMoviesFromMultiWordStrategy(): void
    {
        //act
        $result = $this->SUT->getRecommendations(MovieRecommendationType::MULTI_WORD);

        //assert
        foreach ($result as $movie) {
            $this->assertGreaterThan(1, str_word_count($movie));
        }
    }

    public function testReturnsErrorForInvalidType()
    {
        //assert
        $this->expectException(StrategyWasNotRegistered::class);

        //arrange
        $SUT = new MovieRecommender(
            [
                MovieRecommendationType::W_EVEN->value => new MoviesStartingWithWAndEvenLengthStrategy(),
                MovieRecommendationType::MULTI_WORD->value => new MultiWordStrategy(),
            ],
            self::$movies,
        );

        //act
        $SUT->getRecommendations(MovieRecommendationType::RANDOM);
    }
}
