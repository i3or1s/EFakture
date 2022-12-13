<?php

namespace i3or1s\EFakture\ResourceStream;

use i3or1s\EFakture\Model\SEFStorageInterface;
use i3or1s\EFakture\Storage\StorageInterface;

/**
 * @extends \ArrayAccess<int, SEFStorageInterface>
 * @extends \Iterator<SEFStorageInterface>
 */
interface ResourceStreamInterface extends \Iterator, \Countable, \ArrayAccess
{
    public function getStorageInterface(): StorageInterface;
}
