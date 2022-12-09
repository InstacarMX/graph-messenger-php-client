<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\Exception;

use Instacar\GraphMessengerApi\Model\Error;

class GraphException extends \Exception
{
    private int $statusCode;

    private Error $error;

    public function __construct(int $statusCode, Error $error)
    {
        parent::__construct($error->getMessage(), $error->getCode());
        $this->statusCode = $statusCode;
        $this->error = $error;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getError(): Error
    {
        return $this->error;
    }
}
