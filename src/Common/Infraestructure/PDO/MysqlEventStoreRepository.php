<?php

declare(strict_types=1);

namespace Common\Infraestructure\PDO;

use Common\Domain\DomainEvent\StoredEvent;
use Common\Domain\DomainEvent\EventStoreRepository;

final class MysqlEventStoreRepository extends BaseRepository implements EventStoreRepository
{
    public function append(StoredEvent $storedEvent)
    {
        $stmt = $this->pdo()->prepare(\sprintf('
            INSERT INTO `domain_event` 
                (`type`, `eventBody`, `occurredOn`) 
            VALUES 
                (:type, :eventBody , FROM_UNIXTIME(:occurredOn))
        '));
        $stmt->bindValue('type', (string) $storedEvent->type());
        $stmt->bindValue('eventBody', $storedEvent->eventBody());
        $stmt->bindValue('occurredOn', $storedEvent->occurredOn());

        return $stmt->execute();
    }

    public function allStoredEventsSince(int $anEventId)
    {
        $stmt = $this->pdo()->prepare(\sprintf('SELECT * FROM domain_event where id > :anEventId'));
        $stmt->bindValue('anEventId', $anEventId);
        $stmt->execute();

        $result = $stmt->fetch();

        if (false === $result) {
            return null;
        }

        return StoredEvent::fromArray($result);
    }
}