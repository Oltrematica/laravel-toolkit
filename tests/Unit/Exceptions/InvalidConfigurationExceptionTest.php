<?php

declare(strict_types=1);

use Oltrematica\Toolkit\Exceptions\InvalidConfigurationException;

it('can be instantiated with a message', function (): void {
    // Arrange
    $message = 'Test exception message';

    // Act
    $exception = new InvalidConfigurationException($message);

    // Assert
    expect($exception->getMessage())->toBe($message)
        ->and($exception->getCode())->toBe(0)
        ->and($exception->getPrevious())->toBeNull()
        ->and($exception->getValidationErrors())->toBe([]);
});

it('can be instantiated with a message and code', function (): void {
    // Arrange
    $message = 'Test exception message';
    $code = 123;

    // Act
    $exception = new InvalidConfigurationException($message, $code);

    // Assert
    expect($exception->getMessage())->toBe($message)
        ->and($exception->getCode())->toBe($code)
        ->and($exception->getPrevious())->toBeNull()
        ->and($exception->getValidationErrors())->toBe([]);
});

it('can be instantiated with a message, code, and previous exception', function (): void {
    // Arrange
    $message = 'Test exception message';
    $code = 123;
    $previousException = new Exception('Previous exception');

    // Act
    $exception = new InvalidConfigurationException($message, $code, $previousException);

    // Assert
    expect($exception->getMessage())->toBe($message)
        ->and($exception->getCode())->toBe($code)
        ->and($exception->getPrevious())->toBe($previousException)
        ->and($exception->getValidationErrors())->toBe([]);
});

it('can be instantiated with validation errors', function (): void {
    // Arrange
    $message = 'Test exception message';
    $validationErrors = ['field1' => 'Error 1', 'field2' => 'Error 2'];

    // Act
    $exception = new InvalidConfigurationException($message, 0, null, $validationErrors);

    // Assert
    expect($exception->getMessage())->toBe($message)
        ->and($exception->getValidationErrors())->toBe($validationErrors);
});

it('returns validation errors using getValidationErrors method', function (): void {
    // Arrange
    $validationErrors = ['field_name' => 'The field_name is required.'];
    $exception = new InvalidConfigurationException('Validation failed', 0, null, $validationErrors);

    // Act
    $errors = $exception->getValidationErrors();

    // Assert
    expect($errors)->toBe($validationErrors);
});
