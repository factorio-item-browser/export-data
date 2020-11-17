<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Collection;

use Countable;
use FactorioItemBrowser\ExportData\Storage\Storage;
use IteratorAggregate;
use Traversable;

/**
 * The collection persisting the items in chunks.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @template T of object
 * @implements IteratorAggregate<int, T>
 */
class ChunkedCollection implements Countable, IteratorAggregate
{
    private const CHUNK_SIZE = 1024;

    private Storage $storage;
    private string $itemClass;
    private string $prefix;
    private int $numberOfItems;
    private int $nextChunk = 0;
    /** @var array<T> */
    private array $items = [];

    /**
     * @param Storage $storage
     * @param class-string<T> $itemClass
     * @param int $numberOfItems
     */
    public function __construct(Storage $storage, string $itemClass, int $numberOfItems = 0)
    {
        $this->storage = $storage;
        $this->itemClass = $itemClass;
        $this->numberOfItems = $numberOfItems;
        $this->prefix = strtolower(substr($itemClass, (int) strrpos($itemClass, '\\') + 1));
    }

    /**
     * @param T $item
     * @return $this
     */
    public function add(object $item): self
    {
        $this->loadAllChunks();
        $this->items[] = $item;
        ++$this->numberOfItems;
        return $this;
    }

    public function getIterator(): Traversable
    {
        yield from $this->items;
        while (count($items = $this->loadNextChunk()) > 0) {
            yield from $items;
        }
    }

    public function count(): int
    {
        return $this->numberOfItems;
    }

    public function persist(): void
    {
        $this->loadAllChunks();
        foreach (array_chunk($this->items, self::CHUNK_SIZE) as $index => $chunk) {
            $this->storage->writeData("{$this->prefix}/{$index}", $chunk);
        }
    }

    private function loadAllChunks(): void
    {
        do {
            $items = $this->loadNextChunk();
        } while (count($items) > 0);
    }

    /**
     * @return array<T>
     */
    private function loadNextChunk(): array
    {
        // Check if we are already done loading the chunks.
        if ($this->nextChunk < 0 || $this->nextChunk * self::CHUNK_SIZE >= $this->numberOfItems) {
            $this->nextChunk = -1;
            return [];
        }

        /** @phpstan-var class-string<mixed> $type */
        $type = "array<{$this->itemClass}>";
        $items = $this->storage->readData("{$this->prefix}/{$this->nextChunk}", $type);
        array_push($this->items, ...$items);
        ++$this->nextChunk;

        return $items;
    }
}
