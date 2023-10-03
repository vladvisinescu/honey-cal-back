<?php

namespace HoneyCal\Shared\Domain;

use DateTime;
use DateTimeInterface;
use RuntimeException;

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

    public static function jsonDecode(string $json): array
    {
        $data = json_decode($json, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new RuntimeException('Unable to parse response body into JSON: ' . json_last_error());
        }

        return $data;
    }
}
