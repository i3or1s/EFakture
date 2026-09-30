<?php

namespace i3or1s\EFakture\Util;

/**
 * i3or1s/ubl escapes identifiers (NormalizedString) but writes text elements (names,
 * addresses, notes) as given, so text passed to them is escaped here first.
 */
final class Xml
{
    public static function text(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}
