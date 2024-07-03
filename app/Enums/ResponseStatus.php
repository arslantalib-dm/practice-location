<?php

namespace App\Enums;

class ResponseStatus
{
    const SUCCESS = 200;
    const CREATED = 201;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const INTERNAL_SERVER_ERROR = 500;
    const FORBIDDEN = 401;
}
