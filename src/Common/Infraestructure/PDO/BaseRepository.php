<?php

declare(strict_types=1);

namespace Common\Infraestructure\PDO;

abstract class BaseRepository
{
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function pdo(): \PDO
    {
        return $this->connection->connection();
    }
}
