<?php

namespace HoneyCal\Shared\Domain;

use DateTime;
use DateTimeInterface;

final class Utils
{
    public static function dateToString(DateTimeInterface $date): string
    {
        return $date->format(DateTimeInterface::ATOM);
    }

    public static function checkValidDateString(string $date, string $format = 'Y-m-d H:i:s'): bool
    {
        return DateTime::createFromFormat($format, $date) !== false;
    }
}
