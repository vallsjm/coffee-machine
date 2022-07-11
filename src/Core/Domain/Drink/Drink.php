<?php

declare(strict_types=1);

namespace Core\Domain\Drink;

final class Drink
{
    private function __construct(
        private DrinkType $type,
        private DrinkPrice $price
    ) {}

    public static function create(
        DrinkType $type,
        DrinkPrice $price
    ): self {
        return new self($type, $price);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            DrinkType::fromString($data['type']),
            DrinkPrice::fromFloat((float) $data['price'])
        );
    }

    public function type(): DrinkType
    {
        return $this->type;
    }

    public function price(): DrinkPrice
    {
        return $this->price;
    }
}
