<?php

namespace app\helpers;

/**
 * Class PersonalCodeParser
 * @package app\helpers
 */
class PersonalCodeParser
{
    public static function parseAge(int $personalCode): \DateTime
    {
        if (!preg_match('/^(\d)(\d{2})([0-1]\d)(\d{2})(\d{3})\d$/', $personalCode, $matches)) {
            throw new \Exception('Invalid Personal Code');
        }

        $year = intval(17 + $matches[1] / 2) * 100 + $matches[2];
        $month = $matches[3];
        $day = $matches[4];

        if (!checkdate($month, $day, $year)) {
            throw new \Exception('Invalid Personal Code');
        }

        return (new \DateTime())->setDate($year, $month, $day);
    }
}
