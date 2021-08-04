<?php

declare(strict_types=1);

namespace Common\Domain\DomainEvent;

final class PersistDomainEventSubscriber implements DomainEventSubscriber
{
    private $eventStoreRepository;

    public function __construct(EventStoreRepository $eventStoreRepository)
    {
        $this->eventStoreRepository = $eventStoreRepository;
    }

    public function handle(DomainEvent $domainEvent)
    {
        $this->eventStoreRepository->append(
            StoredEvent::fromDomainEvent($domainEvent)
        );
    }

    public function isSubscribedTo(DomainEvent $domainEvent)
    {
        return true;
    }
}