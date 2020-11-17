<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\Translations;
use FactorioItemBrowser\ExportData\Entity\Item;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the item class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Item
 */
class ItemTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $item = new Item();

        $this->assertSame('', $item->type);
        $this->assertEquals(new Translations(), $item->labels);
        $this->assertEquals(new Translations(), $item->descriptions);
        $this->assertSame('', $item->name);
        $this->assertSame('', $item->iconId);
    }
}
