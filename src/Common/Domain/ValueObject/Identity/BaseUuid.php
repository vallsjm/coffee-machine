<?php

declare(strict_types=1);

namespace Common\Domain\ValueObject\Identity;

use Common\Domain\ValueObject\ValueObjectInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class BaseUuid implements ValueObjectInterface
{
    private $uuid;

    private final function __construct(UuidInterface $uuid)
    {
        $this->validate($uuid->toString());
        $this->uuid = $uuid;
    }

    public static function generate(): self
    {
        return new static(Uuid::uuid4());
    }

    public static function fromString(string $uuId): self
    {
        return new static(Uuid::fromString($uuId));
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function value(): string
    {
        return $this->uuid->toString();
    }

    public function equals(ValueObjectInterface $other): bool
    {
        return \get_class($this) === \get_class($other) && $this->uuid->equals($other->uuid);
    }

    abstract public function validate(string $uuid): void;
}
