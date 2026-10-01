<?php

namespace i3or1s\EFakture\UBL;

use i3or1s\UBL\Basic\NormalizedString;
use i3or1s\UBL\Basic\XsdBase64Binary;
use i3or1s\UBL\Basic\XsdString;
use i3or1s\UBL\CAC\AdditionalDocumentReference;
use i3or1s\UBL\CBC\EmbeddedDocumentBinaryObject;
use i3or1s\UBL\CBC\ID;

/**
 * A file embedded in the invoice (the invoice PDF, a delivery note, ...), passed to Invoice
 * as an additional document reference.
 */
final class Attachment
{
    public readonly AdditionalDocumentReference $documentReference;

    /**
     * @param string $content the raw file content; it is base64-encoded here
     */
    public function __construct(string $id, string $filename, string $mimeCode, string $content)
    {
        $this->documentReference = new AdditionalDocumentReference(
            new ID(new NormalizedString($id), null, null, null, null, null, null, null),
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            new \i3or1s\UBL\CAC\Attachment(
                new EmbeddedDocumentBinaryObject(
                    new XsdBase64Binary(base64_encode($content)),
                    null,
                    new NormalizedString($mimeCode),
                    null,
                    null,
                    null,
                    new XsdString($filename)
                ),
                null
            ),
            null,
            null,
            null
        );
    }
}
