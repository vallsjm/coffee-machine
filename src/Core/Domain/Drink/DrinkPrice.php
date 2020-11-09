<?php

declare(strict_types=1);

namespace Core\Domain\Drink;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Common\Domain\ValueObject\Money\BaseMoney;
use Core\Domain\Drink\Exception\DrinkIsNotFree;

final class DrinkPrice extends BaseMoney
{
    public function validate(float $value): void
    {
        try {
            Assertion::greaterThan($value, 0);
        } catch (AssertionFailedException $e) {
            throw DrinkIsNotFree::create();
        }
    }
}