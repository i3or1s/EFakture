<?php

namespace i3or1s\EFakture\Storage;

use i3or1s\EFakture\Model\SEFStorageInterface;

interface StorageInterface
{
    public function isLockedForWriting(): bool;

    public function clear(string $model): bool;

    /**
     * @param SEFStorageInterface[] $model
     */
    public function store(array $model): bool;

    /**
     * @param string[] $record
     */
    public function storeRaw(string $model, array $record, bool $clear = false): bool;

    /**
     * @param array<string, string|int|bool> $data
     *
     * @return array|SEFStorageInterface[]
     */
    public function seek(string $model, array $data): array;

    public function count(string $model): int;

    /**
     * @return SEFStorageInterface[]
     */
    public function retrieve(string $model, int $offset = 0, int $limit = 10): array;
}
