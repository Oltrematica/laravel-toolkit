<?php

declare(strict_types=1);

use Oltrematica\Toolkit\Enums\ResponseStatus;

describe('ResponseStatus Enum', function (): void {
    it('should have correct values for cases', function (): void {
        // Assert
        expect(ResponseStatus::SUCCESS->value)->toBe('success');
        expect(ResponseStatus::ERROR->value)->toBe('error');
        expect(ResponseStatus::FAILURE->value)->toBe('failure');
    });

    it('isSuccess should return true only for SUCCESS case', function (): void {
        // Arrange
        $successStatus = ResponseStatus::SUCCESS;
        $errorStatus = ResponseStatus::ERROR;
        $failureStatus = ResponseStatus::FAILURE;

        // Act & Assert
        expect($successStatus->isSuccess())->toBeTrue();
        expect($errorStatus->isSuccess())->toBeFalse();
        expect($failureStatus->isSuccess())->toBeFalse();
    });

    it('isError should return true only for ERROR case', function (): void {
        // Arrange
        $successStatus = ResponseStatus::SUCCESS;
        $errorStatus = ResponseStatus::ERROR;
        $failureStatus = ResponseStatus::FAILURE;

        // Act & Assert
        expect($errorStatus->isError())->toBeTrue();
        expect($successStatus->isError())->toBeFalse();
        expect($failureStatus->isError())->toBeFalse();
    });

    it('isFailure should return true only for FAILURE case', function (): void {
        // Arrange
        $successStatus = ResponseStatus::SUCCESS;
        $errorStatus = ResponseStatus::ERROR;
        $failureStatus = ResponseStatus::FAILURE;

        // Act & Assert
        expect($failureStatus->isFailure())->toBeTrue();
        expect($successStatus->isFailure())->toBeFalse();
        expect($errorStatus->isFailure())->toBeFalse();
    });
});
