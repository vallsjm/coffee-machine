<?php

declare(strict_types=1);

namespace Core\Domain\Order;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Common\Domain\ValueObject\Number\BaseInteger;
use Core\Domain\Order\Type\OrderSugarType;
use Core\Domain\Order\Exception\InvalidOrderSugarQuantity;

final class OrderSugar extends BaseInteger
{
    public function validate(int $value): void
    {
        try {
            Assertion::min($value, OrderSugarType::SUGAR_MIN);
            Assertion::max($value, OrderSugarType::SUGAR_MAX);
        } catch (AssertionFailedException $e) {
            throw InvalidOrderSugarQuantity::create(OrderSugarType::SUGAR_MIN, OrderSugarType::SUGAR_MAX);
        }
    }
}
