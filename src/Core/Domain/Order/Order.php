<?php

declare(strict_types=1);

namespace Core\Domain\Order;

use Core\Domain\Drink\Drink;
use Core\Domain\Order\Event\OrderWasCreated;
use Common\Domain\DomainEvent\EventRecorderTrait;

final class Order
{
    use EventRecorderTrait;

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

        $this->recordThat(
            OrderWasCreated::fromOrder($this)
        );
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