<?php

declare(strict_types=1);

namespace Tests\Traits;

trait WordsTrait
{
    private function countWords(string $movie): int
    {
        $movie = preg_replace('/[^\p{L}\p{N}\s]/u', '', $movie);
        $words = preg_split('/\s+/', trim($movie));

        return count($words);
    }
}
