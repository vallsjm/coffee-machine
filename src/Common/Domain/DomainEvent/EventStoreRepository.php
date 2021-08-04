<?php

declare(strict_types=1);

namespace Common\Domain\DomainEvent;

interface EventStoreRepository
{
    public function append(StoredEvent $storedEvent);

    public function allStoredEventsSince(int $anEventId);
}