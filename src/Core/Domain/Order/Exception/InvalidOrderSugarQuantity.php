<?php

declare(strict_types=1);

namespace Core\Domain\Order\Exception;

final class InvalidOrderSugarQuantity extends \InvalidArgumentException
{
    public static function create(int $sugarMin, int $sugarMax): self
    {
        return new self(\sprintf('The number of sugars should be between %d and %d.', $sugarMin, $sugarMax));
    }
}
