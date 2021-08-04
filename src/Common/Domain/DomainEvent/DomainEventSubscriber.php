<?php

declare(strict_types=1);

namespace Common\Domain\DomainEvent;

interface DomainEventSubscriber
{
    public function handle(DomainEvent $domainEvent);

    public function isSubscribedTo(DomainEvent $domainEvent);
}