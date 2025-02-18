<?php

declare(strict_types=1);

namespace MovieRecommendation\Exception;

class StrategyWasNotRegistered extends \Exception
{
    public function __construct(string $type)
    {
        parent::__construct(sprintf("The strategy named '%s' was not registered.", $type));
    }
}
