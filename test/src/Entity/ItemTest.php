<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\TranslationDictionary;
use FactorioItemBrowser\ExportData\Entity\Item;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the item class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @covers \FactorioItemBrowser\ExportData\Entity\Item
 */
class ItemTest extends TestCase
{
    public function testConstruct(): void
    {
        $item = new Item();

        $this->assertSame('', $item->type);
        $this->assertSame('', $item->name);
        $this->assertSame('', $item->iconId);
    }
}
