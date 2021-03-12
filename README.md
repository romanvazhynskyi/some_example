Example of usage

```php
namespace RefactoringExample;

use RefactoringExample\Validator\DtoValidator;
use RefactoringExample\Validator\Rules\GreaterOrEqual;
use RefactoringExample\Validator\Rules\LessOrEqual;

final class SomeDto
{
    public int $id = 10;
    public int $age = 20;
}

$validator = new DtoValidator([
    'id' => [
        new GreaterOrEqual(1),
        new LessOrEqual(1000),
    ],
    'age' => [
        new GreaterOrEqual(10),
        new LessOrEqual(50)
    ]
]);

$validator->validate(new SomeDto());
```