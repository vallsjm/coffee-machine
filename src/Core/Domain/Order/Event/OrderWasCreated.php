<?php

declare(strict_types=1);

namespace Core\Domain\Order\Event;

use Core\Domain\Drink\Drink;
use Core\Domain\Order\Order;
use Core\Domain\Order\OrderSugar;
use Common\Domain\DomainEvent\DomainEventTrait;
use Common\Domain\DomainEvent\DomainEvent;

final class OrderWasCreated implements DomainEvent, \JsonSerializable
{
    use DomainEventTrait;

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

        $this->occurredNow();
    }

    public static function create(
        Drink $drink,
        OrderSugar $sugar,
        bool $extraHot
    ): self {
        return new self($drink, $sugar, $extraHot);
    }

    public static function fromOrder(
        Order $order
    ): self {
        return new self($order->drink(), $order->sugar(), $order->extraHot());
    }

    public function jsonSerialize()
    {
        return [
            'drink' => [
                'type' => (string) $this->drink->type(),
                'price' => (string) $this->drink->price()
            ],
            'sugar' => (bool) $this->sugar,
            'extraHot' => (bool) $this->extraHot
        ];
    }

}