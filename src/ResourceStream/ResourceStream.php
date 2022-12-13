<?php

namespace i3or1s\EFakture\ResourceStream;

use i3or1s\EFakture\Model\SEFStorageInterface;

abstract class ResourceStream implements ResourceStreamInterface
{
    private int $caret = 0;
    protected string $model;

    /**
     * @return SEFStorageInterface[]
     */
    protected function retrieveLines(int $from, int $to): array
    {
        return $this->getStorageInterface()->retrieve($this->model, $from, $to);
    }

    public function current(): ?SEFStorageInterface
    {
        $lines = $this->retrieveLines($this->caret, $this->caret + 1);

        return array_shift($lines);
    }

    public function next(): void
    {
        ++$this->caret;
    }

    public function key(): int
    {
        return $this->caret;
    }

    public function valid(): bool
    {
        $lines = $this->retrieveLines($this->caret, $this->caret + 1);

        return count($lines) > 0;
    }

    public function rewind(): void
    {
        $this->caret = 0;
    }

    public function count(): int
    {
        return $this->getStorageInterface()->count($this->model);
    }

    public function offsetExists(mixed $offset): bool
    {
        return $offset < $this->count();
    }

    public function offsetGet(mixed $offset): SEFStorageInterface|null
    {
        if (!is_int($offset)) {
            return null;
        }
        $lines = $this->retrieveLines($offset, $offset + 1);

        return array_shift($lines);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \Exception('unable to set');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new \Exception('unable to unset');
    }
}
