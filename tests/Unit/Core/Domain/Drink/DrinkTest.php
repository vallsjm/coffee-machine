<?php

declare(strict_types=1);

namespace Tests\Unit\Core\Domain\Drink;

use Core\Domain\Drink\DrinkPrice;
use Core\Domain\Drink\DrinkType;
use PHPUnit\Framework\TestCase;
use Core\Domain\Drink\Drink;

final class DrinkTest extends TestCase
{
    private $drink;

    protected function setUp()
    {
        parent::setUp();

        $price = DrinkPrice::fromFloat(0.6);
        $type = DrinkType::fromString('tea');

        $this->drink = Drink::create(
            $type,
            $price
        );
    }

    public function testCreate()
    {
        self::assertInstanceOf(Drink::class, $this->drink);
    }

    public function testFromArray()
    {
        $data = [
            'type' => 'tea',
            'price' => 0.6
        ];

        $drink = Drink::fromArray($data);

        self::assertInstanceOf(Drink::class, $drink);
    }

    public function testPrice()
    {
        $price = DrinkPrice::fromFloat(0.6);

        self::assertTrue($this->drink->price()->equals($price));
    }

    public function testType()
    {
        $type = DrinkType::fromString('tea');

        self::assertTrue($this->drink->type()->equals($type));
    }

}