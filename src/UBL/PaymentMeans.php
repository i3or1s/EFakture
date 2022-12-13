<?php

namespace i3or1s\EFakture\UBL;

use i3or1s\UBL\Basic\NormalizedString;
use i3or1s\UBL\CAC\PayeeFinancialAccount;
use i3or1s\UBL\CBC\ID;
use i3or1s\UBL\CBC\PaymentID;
use i3or1s\UBL\CBC\PaymentMeansCode;

final class PaymentMeans
{
    public readonly \i3or1s\UBL\CAC\PaymentMeans $paymentMeans;

    public function __construct(string $paymentMeansCode, ?string $paymentCallToNumber, string $payeeAccountNumber)
    {
        $this->paymentMeans = new \i3or1s\UBL\CAC\PaymentMeans(
            null,
            new PaymentMeansCode(
                new NormalizedString($paymentMeansCode),
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ),
            null,
            null,
            null,
            null,
            null !== $paymentCallToNumber ? [new PaymentID(
                new NormalizedString($paymentCallToNumber),
                null,
                null,
                null,
                null,
                null,
                null,
                null
            )] : null,
            null,
            null,
            new PayeeFinancialAccount(
                new ID(
                    new NormalizedString($payeeAccountNumber),
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                ),
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ),
            null,
            null,
            null
        );
    }
}
