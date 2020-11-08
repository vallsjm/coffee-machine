<?php

declare(strict_types=1);

namespace Common\Domain\ValueObject\String;

use Common\Domain\ValueObject\ValueObjectInterface;

abstract class BaseString implements ValueObjectInterface
{
    private $value;

    private final function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new static($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ValueObjectInterface $object): bool
    {
        return \get_class($this) === \get_class($object) && $this->value === $object->value;
    }

    abstract public function validate(string $value): void;
}
