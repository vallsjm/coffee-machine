<?php

declare(strict_types=1);

namespace Core\Domain\Drink\Exception;

final class DrinkIsNotFree extends \InvalidArgumentException
{
    public static function create(): self
    {
        return new self(\sprintf('You must to pay the drink.'));
    }
}
