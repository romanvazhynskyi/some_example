<?php

declare(strict_types=1);

namespace RefactoringExample\Tests\Validator\Rules;

use RefactoringExample\Validator\Rules\GreaterOrEqual;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class GreaterOrEqualTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideValues
     */
    public function checksIntegers(int $value, bool $valid): void
    {
        $this->assertEquals(
            $valid,
            (new GreaterOrEqual(10))->isRespected($value)
        );
    }

    public function provideValues(): iterable
    {
        yield [
            'value' => 10,
            'is it valid?' => true,
        ];

        yield [
            'value' => 11,
            'is it valid?' => true,
        ];

        yield [
            'value' => 9,
            'is it valid?' => false,
        ];
    }
}
