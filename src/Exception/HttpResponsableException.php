<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

abstract class HttpResponsableException extends Exception
{
    abstract public function getStatusCode(): int;
}
