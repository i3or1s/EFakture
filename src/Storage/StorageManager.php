<?php

namespace i3or1s\EFakture\Storage;

final class StorageManager
{
    public readonly StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }
}
