<?php

namespace i3or1s\EFakture\Util;

/**
 * SEF takes a credit note (type 381) only as a UBL CreditNote document; an Invoice root with
 * type 381 is rejected (UBLInvoiceExtensionNotDefined). The two documents share every element
 * the library emits except a few names, so the credit note is produced by renaming them in
 * the generated Invoice XML:
 *
 *   Invoice          -> CreditNote (and the default namespace)
 *   InvoiceTypeCode  -> CreditNoteTypeCode
 *   InvoiceLine      -> CreditNoteLine
 *   InvoicedQuantity -> CreditedQuantity
 *
 * and dropping cbc:DueDate, which a CreditNote does not have.
 */
final class CreditNoteXml
{
    private const INVOICE_NS = 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2';
    private const CREDIT_NOTE_NS = 'urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2';
    private const CAC_NS = 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2';
    private const CBC_NS = 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2';

    private const RENAMES = [
        self::CBC_NS => ['InvoiceTypeCode' => 'cbc:CreditNoteTypeCode', 'InvoicedQuantity' => 'cbc:CreditedQuantity'],
        self::CAC_NS => ['InvoiceLine' => 'cac:CreditNoteLine'],
    ];

    /** The type code of an Invoice document, or null when there is none. */
    public static function typeCode(string $invoiceXml): ?string
    {
        return preg_match('~<cbc:InvoiceTypeCode[^>]*>\s*([^<\s]+)\s*</cbc:InvoiceTypeCode>~', $invoiceXml, $m) ? $m[1] : null;
    }

    public static function fromInvoiceXml(string $invoiceXml): string
    {
        $source = new \DOMDocument();
        if (!$source->loadXML($invoiceXml)) {
            throw new \InvalidArgumentException('Not well-formed invoice XML');
        }
        $root = $source->documentElement;
        if (null === $root || 'Invoice' !== $root->localName || self::INVOICE_NS !== $root->namespaceURI) {
            throw new \InvalidArgumentException('Expected an UBL Invoice document');
        }

        $target = new \DOMDocument('1.0', 'utf-8');
        $creditNote = $target->createElementNS(self::CREDIT_NOTE_NS, 'CreditNote');
        $target->appendChild($creditNote);
        // keep the prefixed namespace declarations (cac, cbc, cec, sbt, ...) on the root
        foreach ((new \DOMXPath($source))->query('namespace::*', $root) as $ns) {
            if ('' !== $ns->prefix && 'xml' !== $ns->prefix) {
                $creditNote->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:'.$ns->prefix, $ns->namespaceURI);
            }
        }
        foreach ($root->attributes as $attribute) {
            $creditNote->setAttributeNode($target->importNode($attribute, true));
        }
        foreach ($root->childNodes as $child) {
            if ($child instanceof \DOMElement && self::CBC_NS === $child->namespaceURI && 'DueDate' === $child->localName) {
                continue;
            }
            $creditNote->appendChild(self::copy($target, $child));
        }

        return (string) $target->saveXML();
    }

    private static function copy(\DOMDocument $target, \DOMNode $node): \DOMNode
    {
        if (!$node instanceof \DOMElement) {
            return $target->importNode($node, true);
        }
        $name = self::RENAMES[$node->namespaceURI][$node->localName] ?? $node->nodeName;
        $copy = $target->createElementNS((string) $node->namespaceURI, $name);
        foreach ($node->attributes as $attribute) {
            $copy->setAttributeNode($target->importNode($attribute, true));
        }
        foreach ($node->childNodes as $child) {
            $copy->appendChild(self::copy($target, $child));
        }

        return $copy;
    }
}
