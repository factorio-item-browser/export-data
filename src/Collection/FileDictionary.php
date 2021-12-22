<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Collection;

use ArrayIterator;
use FactorioItemBrowser\ExportData\Storage\Storage;
use IteratorAggregate;
use Traversable;

/**
 * The dictionary persisting the items directly into the storage.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @implements IteratorAggregate<string, string>
 */
class FileDictionary implements DictionaryInterface, IteratorAggregate
{
    public function __construct(
        private readonly Storage $storage,
        private readonly string $filePattern,
        private readonly bool $compressFiles = true
    ) {
    }

    public function get(string $key): string
    {
        $file = sprintf($this->filePattern, $key);
        return $this->storage->readFile($file);
    }

    public function set(string $key, string $value): void
    {
        $file = sprintf($this->filePattern, $key);
        $this->storage->writeFile($file, $value, $this->compressFiles);
    }

    public function getIterator(): Traversable
    {
        // Unable to actually iterate over the values.
        return new ArrayIterator([]);
    }
}
