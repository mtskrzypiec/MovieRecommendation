<?php

declare(strict_types=1);

namespace src\MovieRecomandation\Enum;

enum MovieRecommendationType: string {
    case RANDOM = 'random';
    case W_EVEN = 'w_even';
    case MULTI_WORD = 'multi_word';
}