<?php

declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Drink;

use Core\Domain\Drink\DrinkType;
use Core\Domain\Drink\Exception\InvalidDrinkType;
use PHPUnit\Framework\TestCase;

final class DrinkTypeTest extends TestCase
{
    public function testInvalidDrinkTypeException()
    {
        self::expectException(InvalidDrinkType::class);
        DrinkType::fromString('orange');
    }

    public function testDrinkTypeSuccess()
    {
        $type = DrinkType::fromString('tea');
        self::assertInstanceOf(DrinkType::class, $type);
    }
}
