<?php

declare(strict_types=1);

namespace Core\Infraestructure\Persistence\PDO;

use Common\Infraestructure\PDO\BaseRepository;
use Core\Domain\Drink\DrinkRepository;
use Core\Domain\Drink\DrinkType;
use Core\Domain\Drink\Drink;

final class MysqlDrinkRepository extends BaseRepository implements DrinkRepository
{
    public function findOneByDrinkType(DrinkType $type): ?Drink
    {
        $stmt = $this->pdo()->prepare(\sprintf('SELECT * FROM drink where type = :type'));
        $stmt->bindValue('type', (string) $type);
        $stmt->execute();

        $result = $stmt->fetch();

        if (false === $result) {
            return null;
        }

        return Drink::fromArray($result);
    }
}
