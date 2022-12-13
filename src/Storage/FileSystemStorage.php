<?php

namespace i3or1s\EFakture\Storage;

use i3or1s\EFakture\Model\SEFStorageInterface;

final class FileSystemStorage implements StorageInterface
{
    private string $cacheLocation;
    private int $seekCaret = 0;
    public readonly bool $lockForWriting;

    public function __construct(string $cacheLocation = '/tmp/sefStorage', bool $lockForWriting = false)
    {
        if ('/tmp/sefStorage' === $cacheLocation) {
            if (is_dir('/tmp')) {
                if (!is_dir('sefStorage')) {
                    mkdir($cacheLocation);
                }
            }
        }
        if (!is_dir($cacheLocation)) {
            throw new \RuntimeException('Cache directory path must be valid!');
        }
        $this->cacheLocation = $cacheLocation;
        $this->lockForWriting = $lockForWriting;
    }

    public function isLockedForWriting(): bool
    {
        return $this->lockForWriting;
    }

    public function clear(string $model): bool
    {
        $filename = sprintf('%s/%s.sef', $this->cacheLocation, md5($model));
        if (false === file_put_contents($filename, '')) {
            return false;
        }

        return true;
    }

    /**
     * @param SEFStorageInterface[] $model
     */
    public function store(array $model): bool
    {
        if ($this->lockForWriting) {
            return false;
        }
        foreach ($model as $sefModel) {
            $filename = sprintf('%s/%s.sef', $this->cacheLocation, md5($sefModel::class));
            if (false === file_put_contents($filename, json_encode($sefModel, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES).PHP_EOL, FILE_APPEND)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string[] $records
     */
    public function storeRaw(string $model, array $records, bool $clear = false): bool
    {
        foreach ($records as $record) {
            $filename = sprintf('%s/%s.sef', $this->cacheLocation, md5($model));
            if ($clear) {
                $clear = false;
                if (false === file_put_contents($filename, '')) {
                    return false;
                }
            }
            if (false === file_put_contents($filename, $record, FILE_APPEND)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array<string, string|int|bool> $data
     *
     * @return array|SEFStorageInterface[]
     */
    public function seek(string $model, array $data): array
    {
        $response = [];
        while ($records = $this->retrieve($model, $this->seekCaret, 1000000)) {
            if (0 === count($records)) {
                break;
            }
            foreach ($records as $record) {
                foreach ($data as $key => $value) {
                    if(isset($record->$key)) {
                        if ($record->$key == $value) {
                            $response[] = $record;
                        } else {
                            unset($record);
                        }
                    }
                }
            }
            $this->seekCaret += 1000000;
        }
        $this->seekCaret = 0;

        return $response;
    }

    public function count(string $model): int
    {
        $filename = sprintf('%s/%s.sef', $this->cacheLocation, md5($model));
        if (!file_exists($filename)) {
            return 0;
        }
        $size = 0;
        $fileHandle = fopen($filename, 'r');
        if(false === $fileHandle) {
            return $size;
        }
        while (!feof($fileHandle)) {
            $line = fgets($fileHandle);
            if (false !== $line) {
                ++$size;
            }
        }
        fclose($fileHandle);

        return $size;
    }

    /**
     * @return SEFStorageInterface[]
     */
    public function retrieve(string $model, int $offset = 0, int $limit = 10): array
    {
        $filename = sprintf('%s/%s.sef', $this->cacheLocation, md5($model));
        if (!file_exists($filename)) {
            throw new \RuntimeException('Invalid storage location!');
        }
        $response = [];
        $currentLine = 0;
        $fileHandle = fopen($filename, 'r');
        if(false === $fileHandle) {
            return $response;
        }
        while (!feof($fileHandle)) {
            $line = fgets($fileHandle);
            if ($currentLine >= $offset && $currentLine < $limit + $offset) {
                if (false !== $line) {
                    $SEFItem = str_replace(PHP_EOL, '', $line);
                    $SEFItem = json_decode($SEFItem, true);
                    /** @var string[]|null $SEFItem */
                    if(null !== $SEFItem) {
                        /** @var SEFStorageInterface $SEFStorage */
                        $SEFStorage = new $model(...array_values($SEFItem));
                        $response[] = new $SEFStorage;
                    }
                }
            }
            if ($currentLine >= $limit + $offset) {
                fclose($fileHandle);

                return $response;
            }
            ++$currentLine;
        }
        fclose($fileHandle);

        return $response;
    }
}
