![GitHub Tests Action Status](https://github.com/Oltrematica/laravel-toolkit/actions/workflows/run-tests.yml/badge.svg)
![GitHub PhpStan Action Status](https://github.com/Oltrematica/laravel-toolkit/actions/workflows/phpstan.yml/badge.svg)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/oltrematica/laravel-toolkit.svg?style=flat-square)](https://packagist.org/packages/oltrematica/laravel-toolkit)
[![Total Downloads](https://img.shields.io/packagist/dt/oltrematica/laravel-toolkit.svg?style=flat-square)](https://packagist.org/packages/oltrematica/laravel-toolkit)

# Laravel Toolkit

Laravel Toolkit is a curated set of reusable components aimed at improving productivity and consistency across
Oltrematica’s Laravel projects.

This package provides utilities, helpers, macros, traits, and value objects commonly used in our codebase, offering
ready-made solutions for frequent challenges and promoting shared best practices.
Laravel Toolkit was created to centralize cross-cutting or repetitive code, reducing duplication and making maintenance
easier.

Features include standardized operation result handling (Result pattern), string, array, and date helpers, Eloquent and
Collection macros, reusable traits, and other tools for everyday development.

The package is designed to be lightweight, modular, and easily extensible, adapting to the evolving needs of
Oltrematica’s teams.

## Prerequisites

- Laravel v10, v11 and v12
- PHP 8.3 or higher

## Installation

```bash
composer require oltrematica/laravel-toolkit
```

# Usage Guide

## Result

The Result class is a simple, immutable value object designed to represent the outcome of an operation in a consistent
way. It allows you to standardize how you return success, error, or failure (with exception) from your services,
actions, or
domain logic.

Use Result to make your service and action return values explicit and consistent, improving error handling and
readability throughout your codebase.

### Creating a Success Result

```php
use Oltrematica\Toolkit\Support\Result;

$result = Result::success('Operation completed successfully', ['foo' => 'bar']);

// Check if successful
if ($result->isSuccess()) {
    $data = $result->getData();
    // Handle success
}
```

### Creating an Error Result

```php
$result = Result::error('Validation failed', ['field' => 'email']);

// Check if error
if ($result->isError()) {
    $message = $result->getMessage();
    $data = $result->getData();
    // Handle error
}
```

### Creating a Failure Result (with Exception)

```php
try {
    // Some operation that may throw
} catch (Throwable $e) {
    $result = Result::failure($e, 'Unexpected exception occurred');
}

// Check if failure (error with exception)
if ($result->isFailure()) {
    $exception = $result->getThrowable();
    // Handle failure, log exception, etc.
}
```

### Result API Reference

| Method              | Description                                                   |
|---------------------|---------------------------------------------------------------|
| Result::success()   | Create a success result (optionally with message/data)        |
| Result::error()     | Create an error result (optionally with message/data/exception)|
| Result::failure()   | Create an error result with an exception                      |
| isSuccess()         | Returns true if result is successful                          |
| isError()           | Returns true if result is an error (including failures)       |
| isFailure()         | Returns true if result is an error with exception             |
| getMessage()        | Returns the result message                                    |
| getData()           | Returns the attached data                                     |
| getThrowable()      | Returns the exception, if any                                 |

## ResponseStatus Enum

The `ResponseStatus` enum defines a standard set of response statuses to represent the outcome of operations.

```php
use Oltrematica\Toolkit\Enums\ResponseStatus;

$status = ResponseStatus::SUCCESS;

if ($status->isSuccess()) {
    // Handle success
} elseif ($status->isError()) {
    // Handle error
} elseif ($status->isFailure()) {
    // Handle failure
}
```

## Code Quality

The project includes automated tests and tools for code quality control.

### Rector

Rector is a tool for automating code refactoring and migrations. It can be run using the following command:

```shell
composer refactor
```

### PhpStan

PhpStan is a tool for static analysis of PHP code. It can be run using the following command:

```shell
composer analyse
```

### Pint

Pint is a tool for formatting PHP code. It can be run using the following command:

```shell
composer format
```

### Automated Tests

The project includes automated tests and tools for code quality control.

```shell
composer test
```

## Contributing

Feel free to contribute to this package by submitting issues or pull requests. We welcome any improvements or bug fixes
you may have.

