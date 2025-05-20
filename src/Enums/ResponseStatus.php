<?php

declare(strict_types=1);

namespace Oltrematica\Toolkit\Enums;

enum ResponseStatus: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';
    case FAILURE = 'failure';

    public function isSuccess(): bool
    {
        return $this === self::SUCCESS;
    }

    public function isError(): bool
    {
        return $this === self::ERROR;
    }

    public function isFailure(): bool
    {
        return $this === self::FAILURE;
    }
}
