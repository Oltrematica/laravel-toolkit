<?php

declare(strict_types=1);

use Oltrematica\Toolkit\Support\Result;

test('success creates a successful result with default values', function (): void {
    // Arrange / Act
    $result = Result::success();

    // Assert
    expect($result->isSuccess())->toBeTrue();
    expect($result->isError())->toBeFalse();
    expect($result->isFailure())->toBeFalse();
    expect($result->getMessage())->toBe('');
    expect($result->getData())->toBeNull();
    expect($result->getThrowable())->toBeNull();
});

test('success creates a successful result with custom message and data', function (): void {
    // Arrange
    $message = 'Operation completed';
    $data = ['foo' => 'bar'];

    // Act
    $result = Result::success($message, $data);

    // Assert
    expect($result->isSuccess())->toBeTrue();
    expect($result->getMessage())->toBe($message);
    expect($result->getData())->toBe($data);
    expect($result->getThrowable())->toBeNull();
});

test('error creates an error result without throwable', function (): void {
    // Arrange
    $message = 'Something went wrong';
    $data = 123;

    // Act
    $result = Result::error($message, $data);

    // Assert
    expect($result->isSuccess())->toBeFalse();
    expect($result->isError())->toBeTrue();
    expect($result->isFailure())->toBeFalse();
    expect($result->getMessage())->toBe($message);
    expect($result->getData())->toBe($data);
    expect($result->getThrowable())->toBeNull();
});

test('error creates an error result with throwable', function (): void {
    // Arrange
    $message = 'Exception occurred';
    $data = ['bar' => 'baz'];
    $throwable = new RuntimeException('Test exception');

    // Act
    $result = Result::error($message, $data, $throwable);

    // Assert
    expect($result->isSuccess())->toBeFalse();
    expect($result->isError())->toBeTrue();
    expect($result->isFailure())->toBeTrue();
    expect($result->getMessage())->toBe($message);
    expect($result->getData())->toBe($data);
    expect($result->getThrowable())->toBe($throwable);
});

test('failure creates a failure result with throwable', function (): void {
    // Arrange
    $throwable = new InvalidArgumentException('Invalid argument');
    $message = 'Failure occurred';
    $data = 'extra info';

    // Act
    $result = Result::failure($throwable, $message, $data);

    // Assert
    expect($result->isSuccess())->toBeFalse();
    expect($result->isError())->toBeTrue();
    expect($result->isFailure())->toBeTrue();
    expect($result->getMessage())->toBe($message);
    expect($result->getData())->toBe($data);
    expect($result->getThrowable())->toBe($throwable);
});

test('isFailure returns false if error has no throwable', function (): void {
    // Arrange / Act
    $result = Result::error('Error without exception');

    // Assert
    expect($result->isFailure())->toBeFalse();
});

test('isError returns true for both error and failure', function (): void {
    // Arrange
    $errorResult = Result::error('Error');
    $failureResult = Result::failure(new Exception('Fail'));

    // Act / Assert
    expect($errorResult->isError())->toBeTrue();
    expect($failureResult->isError())->toBeTrue();
});

test('getters return correct values for all properties', function (): void {
    // Arrange
    $throwable = new LogicException('Logic fail');
    $message = 'Detailed message';
    $data = ['x' => 42];

    // Act
    $result = Result::error($message, $data, $throwable);

    // Assert
    expect($result->getMessage())->toBe($message);
    expect($result->getData())->toBe($data);
    expect($result->getThrowable())->toBe($throwable);
});
