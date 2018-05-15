<?php

namespace FactorioItemBrowserTest\ExportData\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\LocalisedString;
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
    public function testConstruct()
    {
        $item = new Item();

        $this->assertEquals('', $item->getType());
        $this->assertEquals('', $item->getName());
        $this->assertInstanceOf(LocalisedString::class, $item->getLabels());
        $this->assertInstanceOf(LocalisedString::class, $item->getDescriptions());
        $this->assertEquals(false, $item->getProvidesRecipeLocalisation());
        $this->assertEquals('', $item->getIconHash());
    }

    /**
     * Tests the cloning.
     * @covers ::__clone
     */
    public function testClone()
    {
        $item = new Item();
        $item->setType('foo')
             ->setName('bar')
             ->setProvidesRecipeLocalisation(true)
             ->setIconHash('baz');
        $item->getLabels()->setTranslation('en', 'abc');
        $item->getDescriptions()->setTranslation('en', 'def');

        $clonedItem = clone($item);
        $item->setType('oof')
             ->setName('rab')
             ->setProvidesRecipeLocalisation(false)
             ->setIconHash('zab');
        $item->getLabels()->setTranslation('en', 'cba');
        $item->getDescriptions()->setTranslation('en', 'fde');

        $this->assertEquals('foo', $clonedItem->getType());
        $this->assertEquals('bar', $clonedItem->getName());
        $this->assertEquals(true, $clonedItem->getProvidesRecipeLocalisation());
        $this->assertEquals('baz', $clonedItem->getIconHash());
        $this->assertEquals('abc', $clonedItem->getLabels()->getTranslation('en'));
        $this->assertEquals('def', $clonedItem->getDescriptions()->getTranslation('en'));
    }

    /**
     * Tests setting and getting the type.
     * @covers ::setType
     * @covers ::getType
     */
    public function testSetAndGetType()
    {
        $item = new Item();
        $this->assertEquals($item, $item->setType('foo'));
        $this->assertEquals('foo', $item->getType());
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName()
    {
        $item = new Item();
        $this->assertEquals($item, $item->setName('foo'));
        $this->assertEquals('foo', $item->getName());
    }

    /**
     * Tests setting and getting the labels.
     * @covers ::setLabels
     * @covers ::getLabels
     */
    public function testSetAndGetLabels()
    {
        $labels = new LocalisedString();
        $labels->setTranslation('en', 'foo');

        $item = new Item();
        $this->assertEquals($item, $item->setLabels($labels));
        $this->assertEquals($labels, $item->getLabels());
    }

    /**
     * Tests setting and getting the descriptions.
     * @covers ::setDescriptions
     * @covers ::getDescriptions
     */
    public function testSetAndGetDescriptions()
    {
        $descriptions = new LocalisedString();
        $descriptions->setTranslation('en', 'foo');

        $item = new Item();
        $this->assertEquals($item, $item->setDescriptions($descriptions));
        $this->assertEquals($descriptions, $item->getDescriptions());
    }

    /**
     * Tests setting and getting the provides recipe localisation flag.
     * @covers ::setProvidesRecipeLocalisation
     * @covers ::getProvidesRecipeLocalisation
     */
    public function testSetAndGetProvidesRecipeLocalisation()
    {
        $item = new Item();
        $this->assertEquals($item, $item->setProvidesRecipeLocalisation(true));
        $this->assertEquals(true, $item->getProvidesRecipeLocalisation());
    }

    /**
     * Tests setting and getting the icon hash.
     * @covers ::setIconHash
     * @covers ::getIconHash
     */
    public function testSetAndGetIconHash()
    {
        $item = new Item();
        $this->assertEquals($item, $item->setIconHash('foo'));
        $this->assertEquals('foo', $item->getIconHash());
    }

    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $item = new Item();
        $item->setType('abc')
             ->setName('def')
             ->setProvidesRecipeLocalisation(true)
             ->setIconHash('ghi');
        $item->getLabels()->setTranslation('en', 'jkl');
        $item->getDescriptions()->setTranslation('de', 'mno');

        $data = [
            't' => 'abc',
            'n' => 'def',
            'l' => [
                'en' => 'jkl'
            ],
            'd' => [
                'de' => 'mno'
            ],
            'p' => 1,
            'i' => 'ghi'
        ];

        return [
            [$item, $data],
            [new Item(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param Item $item
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Item $item, array $expectedData)
    {
        $data = $item->writeData();
        $this->assertEquals($expectedData, $data);

        $newItem = new Item();
        $this->assertEquals($newItem, $newItem->readData(new DataContainer($data)));
        $this->assertEquals($newItem, $item);
    }
}
