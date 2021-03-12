<?php

declare(strict_types=1);

namespace RefactoringExample\Validator;

use RefactoringExample\Exception\ObjectPropertyDoesNotExistException;
use RefactoringExample\Exception\ValidationException;
use RefactoringExample\Validator\Rules\Rule;

/**
 * @psalm-immutable
 * @psalm-template T of Rule
 */
final class DtoValidator
{
    /**
     * @psalm-var array<string, T[]>
     */
    private array $rules;

    /**
     * @psalm-param array<string, T[]> $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * @throws ValidationException
     */
    public function validate(object $obj): void
    {
        foreach ($this->rules as $propName => $rules) {
            if (!property_exists($obj, $propName)) {
                throw new ObjectPropertyDoesNotExistException(
                    sprintf('property %s not found in %s', $propName, get_class($obj))
                );
            }
            $this->applyRules($obj->$propName, $rules);
        }
    }

    /**
     * @param T[] $rules
     * @param mixed $value
     */
    private function applyRules($value, array $rules): void
    {
        foreach ($rules as $rule) {
            if (!$rule->isRespected($value)) {
                throw new ValidationException($rule->getMessage());
            }
        }
    }
}
