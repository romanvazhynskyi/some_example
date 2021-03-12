<?php

declare(strict_types=1);

namespace RefactoringExample\Validator\Rules;

/**
 * @psalm-immutable
 */
final class LessOrEqual implements Rule
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function isRespected($value): bool
    {
        return $this->value >= $value;
    }

    public function getMessage(): string
    {
        return sprintf(
            'value must be less than or equal to %d', $this->value
        );
    }
}