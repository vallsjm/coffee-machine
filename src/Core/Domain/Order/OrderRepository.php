<?php

declare(strict_types=1);

namespace Core\Domain\Order;

interface OrderRepository
{
    public function save(Order $order);
    public function resume(): ?array;
}