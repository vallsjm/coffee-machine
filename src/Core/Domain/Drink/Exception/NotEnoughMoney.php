<?php

declare(strict_types=1);

namespace Core\Domain\Drink\Exception;

use Core\Domain\Drink\Drink;

final class NotEnoughMoney extends \InvalidArgumentException
{
    public static function create(Drink $drink): self
    {
        return new self(\sprintf('The %s costs %.01f.', $drink->type(), $drink->price()->value()));
    }
}
