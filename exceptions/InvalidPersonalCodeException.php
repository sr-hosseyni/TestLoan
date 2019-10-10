<?php

namespace app\exceptions;

use Throwable;
use yii\base\Exception;

/**
 * Class InvalidPersonalCode
 * @package app\exceptions
 */
class InvalidPersonalCodeException extends Exception
{
    public function __construct($message = 'Invalid Personal Code', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
