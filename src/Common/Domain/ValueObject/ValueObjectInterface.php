<?php

declare(strict_types=1);

namespace Common\Domain\ValueObject;

interface ValueObjectInterface
{
    public function equals(ValueObjectInterface $object): bool;

    public function __toString(): string;
}
