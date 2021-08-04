<?php

declare(strict_types=1);

namespace Common\Domain\DomainEvent;

trait DomainEventTrait
{
    private $occurredOn;

    public function occurredNow(): void
    {
        $this->occurredOn = (new \DateTimeImmutable)->getTimestamp();
    }

    public function occurredOn(): int
    {
        return $this->occurredOn;
    }
}