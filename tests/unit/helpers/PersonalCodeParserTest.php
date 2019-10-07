<?php

namespace tests\helpers;

use app\helpers\PersonalCodeParser;
use Codeception\Test\Unit;

/**
 * Class UserTest
 * @package tests\models
 */
class UserTest extends Unit
{
    public function testFindUserById()
    {
        $parser = new PersonalCodeParser();

        $age = $parser->parseAge(38710200165);

        $this->assertEquals($age->format('Y-m-d'), '1987-10-20');
    }
}
