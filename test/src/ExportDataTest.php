<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData;

use FactorioItemBrowser\ExportData\Collection\ChunkedCollection;
use FactorioItemBrowser\ExportData\Collection\FileDictionary;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Machine;
use FactorioItemBrowser\ExportData\Entity\Mod;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use FactorioItemBrowser\ExportData\ExportData;
use FactorioItemBrowser\ExportData\Storage\Storage;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ExportData class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\ExportData
 */
class ExportDataTest extends TestCase
{
    public function testConstruct(): void
    {
        $storage = $this->createMock(Storage::class);
        $combinationId = 'abc';

        $instance = new ExportData($storage, $combinationId);

        $this->assertEquals(new ChunkedCollection($storage, Mod::class), $instance->mods);
        $this->assertEquals(new ChunkedCollection($storage, Item::class), $instance->items);
        $this->assertEquals(new ChunkedCollection($storage, Machine::class), $instance->machines);
        $this->assertEquals(new ChunkedCollection($storage, Recipe::class), $instance->recipes);
        $this->assertEquals(new ChunkedCollection($storage, Icon::class), $instance->icons);
        $this->assertInstanceOf(FileDictionary::class, $instance->renderedIcons);
    }
}
