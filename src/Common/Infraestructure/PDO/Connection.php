<?php

declare(strict_types=1);

namespace Common\Infraestructure\PDO;

use PDO;

final class Connection
{
    protected PDO $connection;

    public function __construct(string $connection, string $username, string $password)
    {
        $this->connection = new PDO($connection, $username, $password);
    }

    public function connection(): PDO
    {
        return $this->connection;
    }
}
