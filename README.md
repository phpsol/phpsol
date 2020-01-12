# PHP Standard Object Library (phpsol)
This package aims to provide a strict and sensible library containing commonly used objects.

## Collection
Can only contain elements of the same type.

### Sequence
Contains elements indexed by integer.

### Set
Contains unique elements and is not indexed.

### Map
Contains elements indexed by indicis of a specified type.

## Development
### Tools
* `composer test` - Execute all tests.
* `composer compile` - Validate against coding standards and run static code analysis.
* `composer fix` - Fix coding standard violations where possible.

### IDE
Psalm-specific annotations might not be recognised by your IDE. See https://psalm.dev/docs/running_psalm/language_server on how to get it working in your IDE.
