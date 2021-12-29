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

    private string $prefix;
    private int $nextChunk = 0;
    /** @var array<T> */
    private array $items = [];

    /**
     * @param Storage $storage
     * @param class-string<T> $itemClass
     * @param int $numberOfItems
     */
    public function __construct(
        private readonly Storage $storage,
        private readonly string $itemClass,
        private int $numberOfItems = 0
    ) {
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

    /**
     * @param T $item
     * @return $this
     */
    public function remove(object $item): self
    {
        $this->loadAllChunks();
        foreach ($this->items as $key => $value) {
            if ($value === $item) {
                unset($this->items[$key]);
                --$this->numberOfItems;
                break;
            }
        }
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

        // @phpstan-ignore-next-line
        $items = $this->storage->readData("{$this->prefix}/{$this->nextChunk}", "array<{$this->itemClass}>");
        array_push($this->items, ...$items);
        ++$this->nextChunk;

        return array_slice($this->items, -count($items), null, true);
    }
}
