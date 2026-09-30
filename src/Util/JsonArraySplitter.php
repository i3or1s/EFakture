<?php

namespace i3or1s\EFakture\Util;

/**
 * Splits a streamed top-level JSON array of objects ("[{...},{...}]") into its elements as
 * the chunks arrive, so a large list (the company registry is ~45 MB) never has to be held
 * in memory or decoded in one go. Strings are tracked, so braces inside values are safe.
 */
final class JsonArraySplitter
{
    private string $buffer = '';
    private int $scanned = 0;
    private int $depth = 0;
    private bool $inString = false;
    private ?int $start = null;

    /**
     * @return string[] the JSON text of every element completed by this chunk
     */
    public function push(string $chunk): array
    {
        $this->buffer .= $chunk;
        $length = strlen($this->buffer);
        $elements = [];
        $i = $this->scanned;

        while ($i < $length) {
            if ($this->inString) {
                $i += strcspn($this->buffer, '"\\', $i);
                if ($i >= $length) {
                    break;
                }
                if ('\\' === $this->buffer[$i]) {
                    if ($i + 1 >= $length) {
                        break; // the escaped character is in the next chunk
                    }
                    $i += 2;
                    continue;
                }
                $this->inString = false;
                ++$i;
                continue;
            }

            $i += strcspn($this->buffer, '"{}[]', $i);
            if ($i >= $length) {
                break;
            }
            $char = $this->buffer[$i];
            if ('"' === $char) {
                $this->inString = true;
            } elseif ('{' === $char || '[' === $char) {
                if (1 === $this->depth && '{' === $char) {
                    $this->start = $i;
                }
                ++$this->depth;
            } else {
                --$this->depth;
                if (1 === $this->depth && '}' === $char && null !== $this->start) {
                    $elements[] = substr($this->buffer, $this->start, $i - $this->start + 1);
                    $this->start = null;
                }
            }
            ++$i;
        }

        $keepFrom = $this->start ?? $i;
        $this->buffer = substr($this->buffer, $keepFrom);
        $this->scanned = $i - $keepFrom;
        if (null !== $this->start) {
            $this->start = 0;
        }

        return $elements;
    }
}
