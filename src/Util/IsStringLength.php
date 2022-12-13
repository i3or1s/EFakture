<?php

namespace i3or1s\EFakture\Util;

final class IsStringLength
{
    public static function validate(?string $value, int $min, int $max): bool
    {
        if (null === $value) {
            return true;
        }
        if ($max < $min) {
            return false;
        }

        return mb_strlen($value) >= $min && mb_strlen($value) <= $max;
    }
}
