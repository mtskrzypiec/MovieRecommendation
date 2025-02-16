<?php

declare(strict_types=1);

namespace Tests\Traits;

trait ImportMoviesTrait
{
    public static array $movies = [];

    public static function setUpBeforeClass(): void
    {
        self::$movies = require_once __DIR__ . "/movies.php";
    }
}
