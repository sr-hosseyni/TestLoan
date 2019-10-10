<?php

namespace app\exceptions;

use Codeception\Util\HttpCode;
use yii\web\HttpException;

class UnderAgeException extends HttpException
{
    public function __construct()
    {
        parent::__construct(HttpCode::UNAUTHORIZED, 'Sorry, Loans are not available to underage users!', 0, null);
    }
}
