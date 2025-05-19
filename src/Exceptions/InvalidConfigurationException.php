<?php

declare(strict_types=1);

namespace Oltrematica\Toolkit\Exceptions;

use Exception;
use Throwable;

/**
 * Class InvalidConfigurationException
 *
 * This exception is thrown when there is an invalid configuration.
 */
class InvalidConfigurationException extends Exception
{
    /**
     * @param  array<string, string>  $validationErrors  bags of validation errors
     */
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null,
        public readonly array $validationErrors = []
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array<string, string>
     */
    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}
