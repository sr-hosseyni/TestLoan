<?php

namespace tests\helpers;

use app\exceptions\InvalidPersonalCodeException;
use app\services\PersonalCodeParser;
use Codeception\Test\Unit;

/**
 * Class UserTest
 * @package tests\models
 */
class PersonalCodeParserTest extends Unit
{
    public function getProvidedRightData()
    {
        return [
            [50001010100, '2000-01-01'],
            [60001010100, '2000-01-01'],
            [51009160100, '2010-09-16'],
            [60912310123, '2009-12-31'],
            [38710200165, '1987-10-20'],
            [48709160100, '1987-09-16'],
            [39912310005, '1999-12-31'],
            [49912310030, '1999-12-31'],
        ];
    }

    public function getProvidedWrongData()
    {
        return [
            [5100916010],
            [11312320123],
            [38700200165],
            [48713160100],
            [48713000100],
        ];
    }

    /**
     * @param int $personalCode
     * @param string $expected
     * @throws \Exception
     *
     * @dataProvider getProvidedRightData
     */
    public function testParseBirthDatePositive(int $personalCode, string $expected)
    {
        $parser = new PersonalCodeParser();
        $birthDate = $parser->parseBirthDate($personalCode);
        $this->assertEquals($expected, $birthDate->format('Y-m-d'));
    }

    /**
     * @param int $personalCode
     * @throws \Exception
     *
     * @dataProvider getProvidedWrongData
     */
    public function testParseBirthDateNegative(int $personalCode)
    {
        $this->expectException(InvalidPersonalCodeException::class);

        $parser = new PersonalCodeParser();
        $parser->parseBirthDate($personalCode);
    }


}
