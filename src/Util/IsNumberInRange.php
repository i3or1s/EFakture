<?php

namespace i3or1s\EFakture\Util;

final class IsNumberInRange
{
    public static function range(null|int|float $number, int $min, int $max): bool
    {
        if (null === $number) {
            return true;
        }
        if ($max < $min) {
            return false;
        }

        return $number >= $min && $number <= $max;
    }
}
