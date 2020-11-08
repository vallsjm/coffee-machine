<?php

declare(strict_types=1);

namespace Common\Domain\ValueObject\Money;

use Common\Domain\ValueObject\ValueObjectInterface;

abstract class BaseMoney implements ValueObjectInterface
{
    private $value;

    private final function __construct(float $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public static function fromBase(BaseMoney $value): self
    {
        return new static($value->value());
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
        return number_format($this->value, 2, '.', '');
    }

    public function value(): float
    {
        return $this->value;
    }

    public function inc(): self
    {
        return new static((float) bcadd((string) $this, '1', 2));
    }

    public function dec(): self
    {
        return new static((float) bcsub((string) $this, '1', 2));
    }

    public function add(BaseMoney $money): self
    {
        return new static((float) bcadd((string) $this, (string) $money, 2));
    }

    public function sub(BaseMoney $money): self
    {
        return new static((float) bcsub((string) $this, (string) $money, 2));
    }

    public function mul(BaseMoney $money): self
    {
        return new static((float) bcmul((string) $this, (string) $money, 2));
    }

    public function div(BaseMoney $money): self
    {
        return new static((float) bcdiv((string) $this, (string) $money, 2));
    }

    public function isGreaterThan(BaseMoney $money): bool
    {
        return $this->value > $money->value();
    }

    public function isGreaterThanOrEqualTo(BaseMoney $money): bool
    {
        return $this->value >= $money->value();
    }

    public function isLessThan(BaseMoney $money): bool
    {
        return $this->value < $money->value();
    }

    public function isLessThanOrEqualTo(BaseMoney $money): bool
    {
        return $this->value <= $money->value();
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
