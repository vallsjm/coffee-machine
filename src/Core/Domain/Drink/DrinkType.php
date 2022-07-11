<?php

declare(strict_types=1);

namespace Core\Domain\Drink;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Common\Domain\ValueObject\String\BaseString;
use Core\Domain\Drink\Type\DrinkTypeType;
use Core\Domain\Drink\Exception\InvalidDrinkType;

final class DrinkType extends BaseString
{
    public function validate(string $value): void
    {
        try {
            Assertion::inArray($value, DrinkTypeType::TYPES);
        } catch (AssertionFailedException $e) {
            throw InvalidDrinkType::create();
        }
    }
}
