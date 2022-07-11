<?php

declare(strict_types=1);

namespace Core\Domain\Drink\Exception;

final class InvalidDrinkType extends \InvalidArgumentException
{
    public static function create(): self
    {
        return new self(\sprintf('The drink type should be tea, coffee or chocolate.'));
    }
}
