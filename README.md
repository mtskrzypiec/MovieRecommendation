# MovieRecommender - Movie Recommendation System

## Description

`MovieRecommender` is the main entry point for the movie recommendation service. It allows the use of different movie recommendation strategies that can be registered in the system.

The service works by utilizing the `RecommendationStrategyInterface`, which defines the method for generating recommendations. Each strategy implements its own algorithm for selecting movies, and the user can obtain recommendations based on a defined type.

## Installation

The project requires **PHP 8.3+** and support for namespaces and enums.

In the `require` section of the `composer.json` file, add:

```json
"require": {
    "mateusz/movies": "dev-main"
},
"repositories": [
    {
        "type": "git",
        "url": "git@github.com:mtskrzypiec/MovieRecommendation.git"
    }
]
```

## Usage

### 1. Implementing a Recommendation Strategy

To add a new recommendation strategy, implement the `RecommendationStrategyInterface`.

Example strategy for randomly selecting a movie:

```php
use MovieRecommendation\Strategy\RecommendationStrategyInterface;
use MovieRecommendation\Enum\MovieRecommendationType;

class RandomStrategy implements RecommendationStrategyInterface
{
    public function getType(): MovieRecommendationType
    {
        return MovieRecommendationType::RANDOM;
    }

    public function getRecommendations(array $movies): array
    {
        shuffle($movies);
        return array_slice($movies, 0, 5); // Returns 5 random movies
    }
}
```

### 2. Initializing the Recommender

Create an instance of `MovieRecommender`, passing a list of strategies and available movies.

```php
use MovieRecommendation\MovieRecommender;
use MovieRecommendation\Enum\MovieRecommendationType;

$movies = ['Inception', 'Titanic', 'Avatar', 'Interstellar', 'The Matrix'];
$strategies = [
    new RandomStrategy(),
    new MoviesStartingWithWAndEvenLengthStrategy(),
    new MultiWordStrategy()
];

$recommender = new MovieRecommender($strategies, $movies);
```

### 3. Retrieving Recommendations

To get recommendations, call the `getRecommendations()` method, passing the appropriate strategy type:

```php
try {
    $recommendedMovies = $recommender->getRecommendations(MovieRecommendationType::RANDOM);
    print_r($recommendedMovies);
} catch (StrategyWasNotRegistered $e) {
    echo "Error: " . $e->getMessage();
}
```

## Supported Recommendation Strategies

The service supports different types of movie recommendations, defined in `MovieRecommendationType`:

- **`RANDOM`** - Returns 3 random titles.
- **`W_EVEN`** - Returns all movies starting with the letter 'W' but only if their title has an even number of characters.
- **`MULTI_WORD`** - Returns all titles that consist of more than one word.

## Error Handling

If a user tries to retrieve recommendations for a strategy that has not been registered, an exception `StrategyWasNotRegistered` will be thrown.

```php
try {
    $recommender->getRecommendations(MovieRecommendationType::W_EVEN);
} catch (StrategyWasNotRegistered $e) {
    echo "Strategy was not registered: " . $e->getMessage();
}
```

You can extend functionality by adding your own recommendation strategies tailored to your needs!
