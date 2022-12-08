<?php

namespace Instacar\GraphMessengerApi\Response;

use Instacar\GraphMessengerApi\Model\Error;

final class ErrorResponse
{
    private Error $error;

    public function __construct(Error $error)
    {
        $this->error = $error;
    }

    public function getError(): Error
    {
        return $this->error;
    }
}