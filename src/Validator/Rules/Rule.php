<?php

declare(strict_types=1);

namespace RefactoringExample\Validator\Rules;

/**
 * @psalm-immutable
 */
interface Rule
{
    /**
     * @param mixed $value
     */
    public function isRespected($value): bool;

    public function getMessage(): string;
}
