<?php

declare(strict_types=1);

namespace Common\Domain\DomainEvent;

interface DomainEvent
{
    public function occurredOn(): int;
}