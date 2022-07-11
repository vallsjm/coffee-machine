<?php

declare(strict_types=1);

namespace Common\Infraestructure\PDO;

use PDO;

final class Connection
{
    /**
     * @var PDO
     */
    protected $connection;

    public function __construct(string $connection, string $username, string $password)
    {
        $this->connection = new PDO($connection, $username, $password);
        //$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_EMULATE_PREPARES);
    }

    public function connection(): PDO
    {
        return $this->connection;
    }
}
