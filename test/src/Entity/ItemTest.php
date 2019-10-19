<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\LocalisedString;
use PHPUnit\Framework\MockObject\MockObject;
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
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $item = new Item();

        $this->assertSame('', $item->getType());
        $this->assertSame('', $item->getName());
        $this->assertSame('', $item->getIconId());

        // Asserted through type-hints
        $item->getLabels();
        $item->getDescriptions();
    }

    /**
     * Tests the setting and getting the type.
     * @covers ::getType
     * @covers ::setType
     */
    public function testSetAndGetType(): void
    {
        $type = 'abc';
        $item = new Item();

        $this->assertSame($item, $item->setType($type));
        $this->assertSame($type, $item->getType());
    }

    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $item = new Item();

        $this->assertSame($item, $item->setName($name));
        $this->assertSame($name, $item->getName());
    }

    /**
     * Tests setting and getting the labels.
     * @covers ::setLabels
     * @covers ::getLabels
     */
    public function testSetAndGetLabels(): void
    {
        /* @var LocalisedString&MockObject $labels */
        $labels = $this->createMock(LocalisedString::class);
        $item = new Item();

        $this->assertSame($item, $item->setLabels($labels));
        $this->assertSame($labels, $item->getLabels());
    }

    /**
     * Tests setting and getting the descriptions.
     * @covers ::setDescriptions
     * @covers ::getDescriptions
     */
    public function testSetAndGetDescriptions(): void
    {
        /* @var LocalisedString&MockObject $descriptions */
        $descriptions = $this->createMock(LocalisedString::class);
        $item = new Item();

        $this->assertSame($item, $item->setDescriptions($descriptions));
        $this->assertSame($descriptions, $item->getDescriptions());
    }

    /**
     * Tests the setting and getting the icon id.
     * @covers ::getIconId
     * @covers ::setIconId
     */
    public function testSetAndGetIconId(): void
    {
        $iconId = 'abc';
        $item = new Item();

        $this->assertSame($item, $item->setIconId($iconId));
        $this->assertSame($iconId, $item->getIconId());
    }
}
