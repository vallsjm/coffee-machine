<?php

declare(strict_types=1);

namespace Core\Domain\Order;

use Core\Domain\Drink\Drink;

final class Order
{
    private $drink;
    private $sugar;
    private $extraHot;

    private function __construct(
        Drink $drink,
        OrderSugar $sugar,
        bool $extraHot
    ) {
        $this->drink = $drink;
        $this->sugar = $sugar;
        $this->extraHot = $extraHot;
    }

    public static function create(
        Drink $drink,
        OrderSugar $sugar,
        bool $extraHot
    ): self {
        return new self($drink, $sugar, $extraHot);
    }

    public function drink(): Drink
    {
        return $this->drink;
    }

    public function sugar(): OrderSugar
    {
        return $this->sugar;
    }

    public function extraHot(): bool
    {
        return $this->extraHot;
    }
}
