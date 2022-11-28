<?php

namespace Boris\EFakture\Model;

final class SendToCir
{
    const DEFAULT = 'Default';
    const AUTO = 'Auto';
    const YES = 'Yes';
    const NO = 'NO';

    public readonly string $sendToCir;

    public function __construct(string $sendToCir = self::DEFAULT)
    {
        if (!self::isValid($sendToCir)) {
            throw new \RuntimeException('invalid.value.send_to_cir');
        }
        $this->sendToCir = $sendToCir;
    }

    public static function isValid(string $sendToCir): bool
    {
        return in_array($sendToCir, [self::DEFAULT, self::AUTO, self::YES, self::NO]);
    }
}
