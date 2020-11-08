<?php

declare(strict_types=1);

namespace Common\Domain\ValueObject\Number;

use Common\Domain\ValueObject\ValueObjectInterface;

abstract class BaseFloat implements ValueObjectInterface
{
    private $value;

    private final function __construct(float $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public static function fromFloat(float $value): self
    {
        return new static($value);
    }

    public static function fromString(string $value): self
    {
        return new static((float) $value);
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function value(): float
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

    public function add(BaseFloat $number): self
    {
        return new static($this->value + $number->value());
    }

    public function sub(BaseFloat $number): self
    {
        return new static($this->value - $number->value());
    }

    public function mul(BaseFloat $number): self
    {
        return new static($this->value * $number->value());
    }

    public function div(BaseFloat $number): self
    {
        return new static($this->value / $number->value());
    }

    public function isGreaterThan(BaseFloat $number): bool
    {
        return $this->value > $number->value();
    }

    public function isGreaterThanOrEqualTo(BaseFloat $number): bool
    {
        return $this->value >= $number->value();
    }

    public function isLessThan(BaseFloat $number): bool
    {
        return $this->value < $number->value();
    }

    public function isLessThanOrEqualTo(BaseFloat $number): bool
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

    abstract public function validate(float $value): void;
}
