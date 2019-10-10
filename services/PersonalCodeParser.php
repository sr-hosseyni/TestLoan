<?php

namespace app\services;

use app\exceptions\InvalidPersonalCodeException;
use DateTime;

/**
 * Class PersonalCodeParser
 * @package app\helpers
 */
class PersonalCodeParser
{
    const UNDERAGE_MEASUREMENT = 18;

    /**
     * @param int $personalCode
     * @return DateTime
     * @throws \Exception
     */
    public function parseBirthDate(int $personalCode): \DateTime
    {
        if (!preg_match('/^(\d)(\d{2})([0-1]\d)(\d{2})(\d{3})\d$/', $personalCode, $matches)) {
            throw new InvalidPersonalCodeException();
        }

        $year = intval(18 + ($matches[1] - 1) / 2) * 100 + $matches[2];
        $month = $matches[3];
        $day = $matches[4];

        if (!checkdate($month, $day, $year)) {
            throw new InvalidPersonalCodeException();
        }

        return (new \DateTime())->setDate($year, $month, $day);
    }

    /**
     * @param int $personalCode
     * @return int
     * @throws \Exception
     */
    public function parseAge(int $personalCode): int
    {
        return date_diff($this->parseBirthDate($personalCode), new DateTime())->format('%y');
    }

    /**
     * @param int $personalCode
     * @param int $age
     * @return bool
     * @throws \Exception
     */
    public function checkIsUnderage(int $personalCode, $age = self::UNDERAGE_MEASUREMENT)
    {
        return $this->parseAge($personalCode) < $age;
    }
}
