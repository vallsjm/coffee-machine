<?php

declare(strict_types=1);

namespace Tests\Unit\Core\Application\Service;

use Core\Domain\Order\Order;
use Core\Domain\Drink\Drink;
use Core\Domain\Drink\Exception\InvalidDrinkType;
use Core\Domain\Drink\Exception\NotEnoughMoney;
use Core\Domain\Order\Exception\InvalidOrderSugarQuantity;
use Core\Domain\Order\OrderSugar;
use PHPUnit\Framework\TestCase;
use Core\Application\Service\MachineService;
use Core\Domain\Drink\DrinkRepository;
use Core\Domain\Order\OrderRepository;

final class MachineServiceTest extends TestCase
{
    private $machine;
    private $drink;

    public function setUp(): void
    {
        $this->drink = Drink::fromArray([
            'type' => 'tea',
            'price' => 0.6
        ]);

        $orderRepositoryMock = $this->createMock(OrderRepository::class);
        $drinkRepositoryMock = $this->createMock(DrinkRepository::class);
        $drinkRepositoryMock->method('findOneByDrinkType')
            ->willReturn($this->drink);

        $this->machine = new MachineService(
            $drinkRepositoryMock,
            $orderRepositoryMock
        );
    }

    public function testPayDrinkWithEnoughMoney()
    {
        $drink = $this->machine->payDrink('tea', '1');
        self::assertInstanceOf(Drink::class, $drink);
    }

    public function testPayDrinkWithoutEnoughMoney()
    {
        self::expectException(NotEnoughMoney::class);
        $this->machine->payDrink('tea', '0.1');
    }

    public function testPayDrinkWithInvalidDrink()
    {
        self::expectException(InvalidDrinkType::class);
        $this->machine->payDrink('orange', '0.1');
    }

    public function testCreateOrderWithTenSugars()
    {
        self::expectException(InvalidOrderSugarQuantity::class);
        $this->machine->createOrder($this->drink, '10', true);
    }

    /**
     * @dataProvider ordersProvider
     */
    public function testOrderStatusReturnsTheExpectedOutput(
        int $sugars,
        bool $extraHot,
        string $expectedOutput
    ): void {
        $order = Order::create(
            $this->drink,
            OrderSugar::fromInteger($sugars),
            $extraHot
        );
        $output = $this->machine->orderStatus($order);
        $this->assertSame($expectedOutput, $output);
    }

    public function ordersProvider(): array
    {
        return [
            [
                1, false, 'You have ordered a tea with 1 sugars (stick included)'
            ],
            [
                0, true, 'You have ordered a tea extra hot'
            ],
            [
                2, true, 'You have ordered a tea extra hot with 2 sugars (stick included)'
            ],
        ];
    }

}