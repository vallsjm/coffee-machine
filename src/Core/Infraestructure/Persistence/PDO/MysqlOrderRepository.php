<?php

declare(strict_types=1);

namespace Core\Infraestructure\Persistence\PDO;

use Common\Infraestructure\PDO\BaseRepository;
use Core\Domain\Order\Order;
use Core\Domain\Order\OrderRepository;

final class MysqlOrderRepository extends BaseRepository implements OrderRepository
{
    public function save(Order $order)
    {
        $stmt = $this->pdo()->prepare(\sprintf('
            INSERT INTO `order` 
                (`type`, `price`, `sugar`, `extrahot`) 
            VALUES 
                (:type, :price , :sugar, :extrahot)
        '));
        $stmt->bindValue('type', (string) $order->drink()->type());
        $stmt->bindValue('price', $order->drink()->price()->value());
        $stmt->bindValue('sugar', $order->sugar()->value());
        $stmt->bindValue('extrahot', $order->extraHot() ? 1 : 0);
        return $stmt->execute();
    }

    public function resume(): ?array
    {
        $stmt = $this->pdo()->prepare(\sprintf('select d.`type` as drink, sum(o.price) as total from `drink` d left join `order` o on d.`type` = o.`type` group by d.`type`'));
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (false === $result) {
            return null;
        }

        return $result;
    }
}