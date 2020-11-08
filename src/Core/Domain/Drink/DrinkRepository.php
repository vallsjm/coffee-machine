<?php

declare(strict_types=1);

namespace Core\Domain\Drink;

use Core\Domain\Drink\DrinkType;
use Core\Domain\Drink\Drink;

interface DrinkRepository
{
    public function findOneByDrinkType(DrinkType $type): ?Drink;
}