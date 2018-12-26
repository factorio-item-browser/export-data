<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\LocalisedString;
use FactorioItemBrowser\ExportData\Utils\EntityUtils;
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
        $this->assertEquals(new LocalisedString(), $item->getLabels());
        $this->assertEquals(new LocalisedString(), $item->getDescriptions());
        $this->assertFalse($item->getProvidesRecipeLocalisation());
        $this->assertFalse($item->getProvidesMachineLocalisation());
        $this->assertSame('', $item->getIconHash());
        $this->assertTrue($item->getIsNew());
    }

    /**
     * Tests the cloning.
     * @covers ::__clone
     */
    public function testClone(): void
    {
        $item = new Item();
        $item->setType('foo')
             ->setName('bar')
             ->setProvidesRecipeLocalisation(true)
             ->setProvidesMachineLocalisation(true)
             ->setIconHash('baz')
             ->setIsNew(false);
        $item->getLabels()->setTranslation('en', 'abc');
        $item->getDescriptions()->setTranslation('en', 'def');

        $clonedItem = clone($item);
        $item->setType('oof')
             ->setName('rab')
             ->setProvidesRecipeLocalisation(false)
             ->setProvidesMachineLocalisation(false)
             ->setIconHash('zab')
             ->setIsNew(true);
        $item->getLabels()->setTranslation('en', 'cba');
        $item->getDescriptions()->setTranslation('en', 'fde');

        $this->assertSame('foo', $clonedItem->getType());
        $this->assertSame('bar', $clonedItem->getName());
        $this->assertTrue($clonedItem->getProvidesRecipeLocalisation());
        $this->assertTrue($clonedItem->getProvidesMachineLocalisation());
        $this->assertSame('baz', $clonedItem->getIconHash());
        $this->assertSame('abc', $clonedItem->getLabels()->getTranslation('en'));
        $this->assertSame('def', $clonedItem->getDescriptions()->getTranslation('en'));
        $this->assertFalse($clonedItem->getIsNew());
    }

    /**
     * Tests setting and getting the type.
     * @covers ::setType
     * @covers ::getType
     */
    public function testSetAndGetType(): void
    {
        $item = new Item();
        $this->assertSame($item, $item->setType('foo'));
        $this->assertSame('foo', $item->getType());
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName(): void
    {
        $item = new Item();
        $this->assertSame($item, $item->setName('foo'));
        $this->assertSame('foo', $item->getName());
    }

    /**
     * Tests setting and getting the labels.
     * @covers ::setLabels
     * @covers ::getLabels
     */
    public function testSetAndGetLabels(): void
    {
        $labels = new LocalisedString();
        $labels->setTranslation('en', 'foo');

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
        $descriptions = new LocalisedString();
        $descriptions->setTranslation('en', 'foo');

        $item = new Item();
        $this->assertSame($item, $item->setDescriptions($descriptions));
        $this->assertSame($descriptions, $item->getDescriptions());
    }

    /**
     * Tests setting and getting the provides recipe localisation flag.
     * @covers ::setProvidesRecipeLocalisation
     * @covers ::getProvidesRecipeLocalisation
     */
    public function testSetAndGetProvidesRecipeLocalisation(): void
    {
        $item = new Item();
        $this->assertSame($item, $item->setProvidesRecipeLocalisation(true));
        $this->assertTrue($item->getProvidesRecipeLocalisation());
    }

    /**
     * Tests setting and getting the provides machine localisation flag.
     * @covers ::setProvidesMachineLocalisation
     * @covers ::getProvidesMachineLocalisation
     */
    public function testSetAndGetProvidesMachineLocalisation(): void
    {
        $item = new Item();
        $this->assertSame($item, $item->setProvidesMachineLocalisation(true));
        $this->assertTrue($item->getProvidesMachineLocalisation());
    }
    
    /**
     * Tests setting and getting the icon hash.
     * @covers ::setIconHash
     * @covers ::getIconHash
     */
    public function testSetAndGetIconHash(): void
    {
        $item = new Item();
        $this->assertSame($item, $item->setIconHash('foo'));
        $this->assertSame('foo', $item->getIconHash());
    }

    /**
     * Tests setting and getting the is new flag.
     * @covers ::setIsNew
     * @covers ::getIsNew
     */
    public function testSetAndGetIsNew(): void
    {
        $item = new Item();
        $this->assertSame($item, $item->setIsNew(false));
        $this->assertFalse($item->getIsNew());
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
             ->setProvidesMachineLocalisation(true)
             ->setIconHash('ghi')
             ->setIsNew(false);
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
            'r' => 1,
            'm' => 1,
            'i' => 'ghi',
            'e' => 0,
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
    public function testWriteAndReadData(Item $item, array $expectedData): void
    {
        $data = $item->writeData();
        $this->assertEquals($expectedData, $data);

        $newItem = new Item();
        $this->assertSame($newItem, $newItem->readData(new DataContainer($data)));
        $this->assertEquals($newItem, $item);
    }

    /**
     * Tests the calculateHash method.
     * @covers ::calculateHash
     */
    public function testCalculateHash(): void
    {
        /* @var LocalisedString|MockObject $labels */
        $labels = $this->getMockBuilder(LocalisedString::class)
                       ->setMethods(['calculateHash'])
                       ->getMock();
        $labels->expects($this->once())
               ->method('calculateHash')
               ->willReturn('jkl');

        /* @var LocalisedString|MockObject $descriptions */
        $descriptions = $this->getMockBuilder(LocalisedString::class)
                             ->setMethods(['calculateHash'])
                             ->getMock();
        $descriptions->expects($this->once())
                     ->method('calculateHash')
                     ->willReturn('mno');

        $item = new Item();
        $item->setType('abc')
             ->setName('def')
             ->setProvidesRecipeLocalisation(true)
             ->setProvidesMachineLocalisation(true)
             ->setIconHash('ghi')
             ->setLabels($labels)
             ->setDescriptions($descriptions)
             ->setIsNew(false);

        $expectedResult = EntityUtils::calculateHashOfArray([
            'abc',
            'def',
            'jkl',
            'mno',
            true,
            true,
            'ghi',
            false,
        ]);

        $result = $item->calculateHash();
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the getIdentifier method.
     * @covers ::getIdentifier
     */
    public function testGetIdentifier(): void
    {
        $item = new Item();
        $item->setType('abc')
             ->setName('def');

        $result = $item->getIdentifier();
        $this->assertSame('abc|def', $result);
    }
}
