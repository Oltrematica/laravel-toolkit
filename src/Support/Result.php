<?php

declare(strict_types=1);

namespace Oltrematica\Toolkit\Support;

use Throwable;

/**
 * The Result class is a simple value object that represents the result of an operation.
 */
final readonly class Result
{
    private function __construct(private bool $success,
        private string $message,
        private mixed $data,
        private ?Throwable $throwable
    ) {}

    /**
     * Create a successful result.
     *
     * @param  string  $message  The message associated with the result.
     * @param  mixed  $data  The data associated with the result.
     * @return self A new instance of the Result class indicating success.
     */
    public static function success(string $message = '', mixed $data = null): self
    {
        return new self(true, $message, $data, null);
    }

    /**
     * Create an error result.
     *
     * @param  string  $message  The message associated with the result.
     * @param  mixed  $data  The data associated with the result.
     * @param  ?Throwable  $throwable  The throwable associated with the error, or null if there is none.
     * @return self A new instance of the Result class indicating an error.
     */
    public static function error(string $message = '', mixed $data = null, ?Throwable $throwable = null): self
    {
        return new self(false, $message, $data, $throwable);
    }

    /**
     * Create a failure result with an exception.
     *
     * @param  Throwable  $throwable  The throwable associated with the failure.
     * @param  string  $message  The message associated with the result.
     * @param  mixed  $data  The data associated with the result.
     * @return self A new instance of the Result class indicating failure.
     */
    public static function failure(Throwable $throwable, string $message = '', mixed $data = null): self
    {
        return new self(false, $message, $data, $throwable);
    }

    /**
     * Determine if it was successful.
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Determine if it failed wiht an exception
     */
    public function isFailure(): bool
    {
        return ! $this->success && $this->throwable instanceof Throwable;
    }

    /**
     * Determine if it failed.
     */
    public function isError(): bool
    {
        return ! $this->success;
    }

    /**
     * Get the message associated with the result.
     *
     * @return string The message associated with the result.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Get the data associated with the result.
     *
     * @return mixed The data associated with the result.
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * Get the throwable associated with the result.
     *
     * @return ?Throwable The throwable associated with the result, or null if there is none.
     */
    public function getThrowable(): ?Throwable
    {
        return $this->throwable;
    }
}
