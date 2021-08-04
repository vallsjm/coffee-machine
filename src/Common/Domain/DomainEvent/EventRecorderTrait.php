<?php

declare(strict_types=1);

namespace Common\Domain\DomainEvent;

trait EventRecorderTrait
{
    public function recordThat(DomainEvent $domainEvent): void
    {
        DomainEventPublisher::instance()->publish(
            $domainEvent
        );
    }
}