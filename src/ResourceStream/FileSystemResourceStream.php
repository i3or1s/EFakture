<?php

namespace i3or1s\EFakture\ResourceStream;

use i3or1s\EFakture\Storage\FileSystemStorage;
use i3or1s\EFakture\Storage\StorageInterface;

final class FileSystemResourceStream extends ResourceStream
{
    private FileSystemStorage $storage;
    protected string $model;

    public function __construct(FileSystemStorage $storage, string $model)
    {
        $this->storage = $storage;
        $this->model = $model;
    }

    public function getStorageInterface(): StorageInterface
    {
        return $this->storage;
    }
}
