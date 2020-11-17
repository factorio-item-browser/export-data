<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Collection;

use FactorioItemBrowser\ExportData\Storage\Storage;

/**
 * The collection persisting the items directly into the storage.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class PersistedCollection
{
    private Storage $storage;
    private string $filePattern;

    public function __construct(Storage $storage, string $filePattern)
    {
        $this->storage = $storage;
        $this->filePattern = $filePattern;
    }

    public function get(string $name): string
    {
        $file = sprintf($this->filePattern, $name);
        return $this->storage->readFile($file);
    }

    public function set(string $name, string $contents): self
    {
        $file = sprintf($this->filePattern, $name);
        $this->storage->writeFile($file, $contents);
        return $this;
    }
}
