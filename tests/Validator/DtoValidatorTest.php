<?php

declare(strict_types=1);

namespace RefactoringExample\Tests\Validator;

use RefactoringExample\Exception\ObjectPropertyDoesNotExistException;
use RefactoringExample\Exception\ValidationException;
use RefactoringExample\Validator\DtoValidator;
use PHPUnit\Framework\TestCase;
use RefactoringExample\Validator\Rules\Rule;

/**
 * @internal
 */
class DtoValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function validatesSomeValue(): void
    {
        $rule = $this->getMockBuilder(Rule::class)->getMock();
        $rule->expects($this->once())
            ->method('isRespected')
            ->with(10)
            ->willReturn(true);

        $validator = new DtoValidator([
            'id' => [$rule]
        ]);
        $validator->validate(new class {
            public int $id = 10;
        });
    }

    /**
     * @test
     */
    public function throwsExceptionIfValidationFails(): void
    {
        $rule = $this->getMockBuilder(Rule::class)->getMock();
        $rule->expects($this->once())
            ->method('isRespected')
            ->with(10)
            ->willReturn(false);

        $validator = new DtoValidator([
            'id' => [$rule]
        ]);

        $this->expectException(ValidationException::class);
        $validator->validate(new class {
            public int $id = 10;
        });
    }

    /**
     * @test
     */
    public function throwsExceptionIfObjectDoesNotContainValidatedProperty(): void
    {
        $rule = $this->getMockBuilder(Rule::class)->getMock();
        $rule->expects($this->never())->method('isRespected');

        $validator = new DtoValidator([
            'id' => [$rule]
        ]);

        $this->expectException(ObjectPropertyDoesNotExistException::class);
        $validator->validate(new class {});
    }
}
