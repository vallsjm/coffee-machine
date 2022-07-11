<?php

declare(strict_types=1);

namespace Core\Application\Service;

use Core\Domain\Drink\Drink;
use Core\Domain\Drink\DrinkPrice;
use Core\Domain\Drink\DrinkRepository;
use Core\Domain\Drink\DrinkType;
use Core\Domain\Order\Order;
use Core\Domain\Order\OrderRepository;
use Core\Domain\Order\OrderSugar;
use Core\Domain\Drink\Exception\NotEnoughMoney;
use Core\Domain\Drink\Exception\DrinkNotFound;

final class MachineService
{
    public function __construct(
        private DrinkRepository $repositoryDrink,
        private OrderRepository $repositoryOrder
    ) {}

    public function payDrink(string $drinkType, string $money): Drink
    {
        $drink = $this->repositoryDrink->findOneByDrinkType(
            DrinkType::fromString($drinkType)
        );

        if (!$drink) {
            throw DrinkNotFound::create();
        }

        $money = DrinkPrice::fromString($money);
        if ($drink->price()->isGreaterThan($money)) {
            throw NotEnoughMoney::create($drink);
        }

        return $drink;
    }

    public function createOrder(Drink $drink, string $sugars, bool $extraHot): Order
    {
        $order = Order::create(
            $drink,
            OrderSugar::fromString($sugars),
            $extraHot
        );

        $this->repositoryOrder->save($order);

        return $order;
    }

    public function resume(): array
    {
        $drinks = $this->repositoryOrder->resume();
        $ret = [];
        foreach ($drinks as $drink) {
            $ret[] = [
                $drink['drink'],
                $drink['total']
            ];
        }
        return $ret;
    }

    public function orderStatus(Order $order): string
    {
        $txt = 'You have ordered a ' . (string) $order->drink()->type();
        if ($order->extraHot()) {
            $txt .= ' extra hot';
        }
        if ($sugars = $order->sugar()->value()) {
            $txt .= ' with ' . $sugars . ' sugars (stick included)';
        }

        return $txt;
    }
}
