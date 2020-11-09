<?php

declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Drink;

use Core\Domain\Drink\DrinkPrice;
use Core\Domain\Drink\Exception\DrinkIsNotFree;
use PHPUnit\Framework\TestCase;

final class DrinkPriceTest extends TestCase
{
    public function testDrinkIsNotFreeException()
    {
        self::expectException(DrinkIsNotFree::class);
        DrinkPrice::fromFloat(0);
    }

    public function testDrinkPriceSuccess()
    {
        $price = DrinkPrice::fromFloat(5);
        self::assertInstanceOf(DrinkPrice::class, $price);
    }
}