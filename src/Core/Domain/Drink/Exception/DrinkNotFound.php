<?php

declare(strict_types=1);

namespace Core\Domain\Drink\Exception;

final class DrinkNotFound extends \InvalidArgumentException
{
    public static function create(): self
    {
        return new self(\sprintf('We don\'t found the drink.'));
    }
}
