<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Collection;

use FactorioItemBrowser\ExportData\Collection\ChunkedCollection;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Storage\Storage;
use Generator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ChunkedCollection class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\Collection\ChunkedCollection
 */
class ChunkedCollectionTest extends TestCase
{
    /** @var Storage&MockObject */
    private Storage $storage;

    protected function setUp(): void
    {
        $this->storage = $this->createMock(Storage::class);
    }

    /**
     * @param int $numberOfItems
     * @param string $prefix
     * @return array<Item>
     */
    private function createItemArray(int $numberOfItems, string $prefix): array
    {
        $items = [];
        foreach (range(1, $numberOfItems) as $index) {
            $item = new Item();
            $item->name = "{$prefix}-{$index}";
            $items[] = $item;
        }
        return $items;
    }

    public function testEmptyCollection(): void
    {
        $item1 = $this->createMock(Item::class);
        $item2 = $this->createMock(Item::class);
        $expectedData = [$item1, $item2];

        $this->storage->expects($this->once())
                      ->method('writeData')
                      ->with($this->identicalTo('item/0'), $this->identicalTo($expectedData));
        $this->storage->expects($this->never())
                      ->method('readData');

        $instance = new ChunkedCollection($this->storage, Item::class);
        $this->assertCount(0, $instance);

        $instance->add($item1)
                 ->add($item2);
        $this->assertCount(2, $instance);

        $instance->persist();
    }

    public function testChunksFromEmptyCollection(): void
    {
        $chunk1 = $this->createItemArray(1024, 'foo');
        $chunk2 = $this->createItemArray(512, 'bar');
        $items = array_merge($chunk1, $chunk2);

        $this->storage->expects($this->exactly(2))
                      ->method('writeData')
                      ->withConsecutive(
                          [$this->identicalTo('item/0'), $this->identicalTo($chunk1)],
                          [$this->identicalTo('item/1'), $this->identicalTo($chunk2)],
                      );

        $instance = new ChunkedCollection($this->storage, Item::class);
        foreach ($items as $item) {
            $instance->add($item);
        }
        $this->assertCount(1536, $instance);

        $instance->persist();
    }

    public function testIteratorWithUnloadedChunks(): void
    {
        $chunk1 = $this->createItemArray(1024, 'foo');
        $chunk2 = $this->createItemArray(512, 'bar');
        $items = array_merge($chunk1, $chunk2);

        $this->storage->expects($this->exactly(2))
                      ->method('readData')
                      ->withConsecutive(
                          [$this->identicalTo('item/0')],
                          [$this->identicalTo('item/1')],
                      )
                      ->willReturnOnConsecutiveCalls(
                          $chunk1,
                          $chunk2
                      );

        $instance = new ChunkedCollection($this->storage, Item::class, 1536);

        // Abort iteration within first chunk.
        $expectedItems = array_slice($items, 0, 512);
        $iteratedItems = [];
        foreach ($instance as $item) {
            $iteratedItems[] = $item;
            if (count($iteratedItems) === 512) {
                break;
            }
        }
        $this->assertEquals($expectedItems, $iteratedItems);

        // Iterate through all of them.
        $iteratedItems = [];
        foreach ($instance as $item) {
            $iteratedItems[] = $item;
        }
        $this->assertEquals($items, $iteratedItems);

        // Iterate through all of them again, to check that no additional read is triggered.
        $iteratedItems = [];
        foreach ($instance as $item) {
            $iteratedItems[] = $item;
        }
        $this->assertEquals($items, $iteratedItems);
    }

    public function testIteratorWithGenerator(): void
    {
        $chunk1 = $this->createItemArray(1024, 'foo');
        $chunk2 = $this->createItemArray(512, 'bar');
        $items = array_merge($chunk1, $chunk2);

        $this->storage->expects($this->exactly(2))
                      ->method('readData')
                      ->withConsecutive(
                          [$this->identicalTo('item/0')],
                          [$this->identicalTo('item/1')],
                      )
                      ->willReturnOnConsecutiveCalls(
                          $chunk1,
                          $chunk2,
                      );

        $instance = new ChunkedCollection($this->storage, Item::class, 1536);

        $generator = function () use ($instance): Generator {
            yield from $instance;
        };

        $result = iterator_to_array($generator());
        $this->assertSame($items, $result);
    }

    public function testCountUnloadedChunks(): void
    {
        $this->storage->expects($this->never())
                      ->method('readData');

        $instance = new ChunkedCollection($this->storage, Item::class, 1536);
        $this->assertCount(1536, $instance);
    }

    public function testAddLoadsAllChunks(): void
    {
        $chunk1 = $this->createItemArray(1024, 'foo');
        $chunk2 = $this->createItemArray(512, 'bar');
        $newItem = new Item();
        $newItem->name = 'new';
        $items = array_merge($chunk1, $chunk2, [$newItem]);

        $this->storage->expects($this->exactly(2))
                      ->method('readData')
                      ->withConsecutive(
                          [$this->identicalTo('item/0')],
                          [$this->identicalTo('item/1')],
                      )
                      ->willReturnOnConsecutiveCalls(
                          $chunk1,
                          $chunk2
                      );

        $instance = new ChunkedCollection($this->storage, Item::class, 1536);
        $instance->add($newItem);
        $this->assertEquals($items, iterator_to_array($instance));
        $this->assertCount(1537, $instance);
    }

    public function testRemoveLoadsAllChunks(): void
    {
        $chunk1 = $this->createItemArray(1024, 'foo');
        $chunk2 = $this->createItemArray(512, 'bar');
        $expectedItems = array_merge($chunk1, $chunk2);
        $item = $expectedItems[42];
        unset($expectedItems[42]);

        $this->storage->expects($this->exactly(2))
                      ->method('readData')
                      ->withConsecutive(
                          [$this->identicalTo('item/0')],
                          [$this->identicalTo('item/1')],
                      )
                      ->willReturnOnConsecutiveCalls(
                          $chunk1,
                          $chunk2
                      );

        $instance = new ChunkedCollection($this->storage, Item::class, 1536);
        $instance->remove($item);
        $this->assertEquals($expectedItems, iterator_to_array($instance));
        $this->assertCount(1535, $instance);
    }

    public function testPersistLoadsAllChunks(): void
    {
        $chunk1 = $this->createItemArray(1024, 'foo');
        $chunk2 = $this->createItemArray(512, 'bar');

        $this->storage->expects($this->exactly(2))
                      ->method('readData')
                      ->withConsecutive(
                          [$this->identicalTo('item/0')],
                          [$this->identicalTo('item/1')],
                      )
                      ->willReturnOnConsecutiveCalls(
                          $chunk1,
                          $chunk2
                      );
        $this->storage->expects($this->exactly(2))
                      ->method('writeData')
                      ->withConsecutive(
                          [$this->identicalTo('item/0'), $this->identicalTo($chunk1)],
                          [$this->identicalTo('item/1'), $this->identicalTo($chunk2)],
                      );

        $instance = new ChunkedCollection($this->storage, Item::class, 1536);
        $instance->persist();
    }
}
