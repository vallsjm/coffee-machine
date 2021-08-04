<?php

declare(strict_types=1);

namespace Common\Domain\DomainEvent;

final class StoredEvent implements DomainEvent
{
    private $eventId;
    private $type;
    private $eventBody;
    private $occurredOn;

    private function __construct(
        string $type,
        string $eventBody,
        int $occurredOn
    ) {
        $this->type = $type;
        $this->eventBody = $eventBody;
        $this->occurredOn = $occurredOn;
    }

    public static function create(
        string $type,
        string $eventBody,
        int $occurredOn
    ): self {
        return new self($type, $eventBody, $occurredOn);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'],
            $data['eventBody'],
            $data['occurredOn']
        );
    }

    public static function fromDomainEvent(DomainEvent $domainEvent): self
    {
        return new self(
            get_class($domainEvent),
            json_encode($domainEvent),
            $domainEvent->occurredOn()
        );
    }

    public function eventBody() :string
    {
        return $this->eventBody;
    }

    public function eventId() :int
    {
        return $this->eventId;
    }

    public function type() :string
    {
        return $this->type;
    }

    public function occurredOn() :int
    {
        return $this->occurredOn;
    }

}