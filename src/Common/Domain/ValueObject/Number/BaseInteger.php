<?php

declare(strict_types=1);

namespace Common\Domain\ValueObject\Number;

use Common\Domain\ValueObject\ValueObjectInterface;

abstract class BaseInteger implements ValueObjectInterface
{
    private $value;

    private final function __construct(int $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public static function fromInteger(int $value): self
    {
        return new static($value);
    }

    public static function fromString(string $value): self
    {
        return new static((int) $value);
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function inc(): self
    {
        $value = $this->value +1;
        return new static($value);
    }

    public function dec(): self
    {
        $value = $this->value -1;
        return new static($value);
    }

    public function add(BaseInteger $number): self
    {
        return new static($this->value + $number->value());
    }

    public function sub(BaseInteger $number): self
    {
        return new static($this->value - $number->value());
    }

    public function mul(BaseInteger $number): self
    {
        return new static($this->value * $number->value());
    }

    public function div(BaseInteger $number): self
    {
        return new static($this->value / $number->value());
    }

    public function isGreaterThan(BaseInteger $number): bool
    {
        return $this->value > $number->value();
    }

    public function isGreaterThanOrEqualTo(BaseInteger $number): bool
    {
        return $this->value >= $number->value();
    }

    public function isLessThan(BaseInteger $number): bool
    {
        return $this->value < $number->value();
    }

    public function isLessThanOrEqualTo(BaseInteger $number): bool
    {
        return $this->value <= $number->value();
    }

    public function isGreaterThanZero(): bool
    {
        return $this->value > 0;
    }

    public function isLessThanZero(): bool
    {
        return $this->value < 0;
    }

    public function equals(ValueObjectInterface $object): bool
    {
        return \get_class($this) === \get_class($object) && $this->value === $object->value;
    }

    abstract public function validate(int $value): void;
}
