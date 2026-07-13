<?php

namespace i3or1s\EFakture\Util;

/**
 * Generic structural XML -> array conversion, suitable for json_encode()-ing an
 * arbitrary XML document (e.g. a downloaded UBL invoice).
 *
 * This is NOT a typed UBL parser: i3or1s\UBL only builds/serializes XML from its
 * own model classes and has no deserializer back into them. Element names are
 * preserved verbatim, including namespace prefixes (e.g. "cbc:ID", "cac:Item").
 * Repeated sibling tags become a list; attributes are nested under "@attributes".
 */
final class XmlToArrayConverter
{
    /**
     * @return array<string, mixed>
     */
    public static function toArray(string $xml): array
    {
        $previousSetting = libxml_use_internal_errors(true);
        try {
            $document = new \DOMDocument();
            if (!$document->loadXML($xml) || null === $document->documentElement) {
                $error = libxml_get_last_error();
                throw new \RuntimeException(sprintf('Failed to parse XML: %s', false !== $error ? trim($error->message) : 'unknown error'));
            }
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousSetting);
        }

        return [$document->documentElement->tagName => self::nodeToArray($document->documentElement)];
    }

    /**
     * @return array<string, mixed>|string
     */
    private static function nodeToArray(\DOMElement $element): array|string
    {
        $attributes = [];
        foreach ($element->attributes ?? [] as $attribute) {
            \assert($attribute instanceof \DOMAttr);
            $attributes[$attribute->nodeName] = $attribute->nodeValue;
        }

        $childrenByTag = [];
        foreach ($element->childNodes as $child) {
            if ($child instanceof \DOMElement) {
                $childrenByTag[$child->tagName][] = self::nodeToArray($child);
            }
        }

        if ([] === $childrenByTag) {
            $text = trim($element->textContent);
            if ([] === $attributes) {
                return $text;
            }

            return ['@attributes' => $attributes, '#text' => $text];
        }

        $result = [] !== $attributes ? ['@attributes' => $attributes] : [];
        foreach ($childrenByTag as $tagName => $values) {
            $result[$tagName] = 1 === count($values) ? $values[0] : $values;
        }

        return $result;
    }
}
