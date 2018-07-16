<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Icon\Color;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the icon class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Icon
 */
class IconTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $icon = new Icon();
        $this->assertSame('', $icon->getHash());
        $this->assertSame(Icon::DEFAULT_SIZE, $icon->getSize());
        $this->assertSame([], $icon->getLayers());
    }

    /**
     * Tests the cloning.
     * @covers ::__clone
     */
    public function testClone()
    {
        $layer = new Layer();
        $layer->setFileName('foo');

        $icon = new Icon();
        $icon->setHash('bar')
             ->addLayer($layer);

        $clonedIcon = clone($icon);
        $icon->setHash('rab');
        $layer->setFileName('oof');

        $this->assertSame('bar', $clonedIcon->getHash());
        $layers = $clonedIcon->getLayers();
        $this->assertSame('foo', array_pop($layers)->getFileName());
    }

    /**
     * Tests setting and getting the hash.
     * @covers ::setHash
     * @covers ::getHash
     */
    public function testSetAndGetHash()
    {
        $icon = new Icon();
        $this->assertSame($icon, $icon->setHash('foo'));
        $this->assertSame('foo', $icon->getHash());
    }

    /**
     * Tests setting and getting the size.
     * @covers ::setSize
     * @covers ::getSize
     */
    public function testSetAndGetSize()
    {
        $icon = new Icon();
        $this->assertSame($icon, $icon->setSize(64));
        $this->assertSame(64, $icon->getSize());
    }
    
    /**
     * Tests setting, adding and getting the layers.
     * @covers ::setLayers
     * @covers ::getLayers
     * @covers ::addLayer
     */
    public function testSetAddAndGetLayers()
    {
        $layer1 = new Layer();
        $layer1->setFileName('abc');
        $layer2 = new Layer();
        $layer2->setFileName('def');
        $layer3 = new Layer();
        $layer3->setFileName('ghi');

        $icon = new Icon();
        $this->assertSame($icon, $icon->setLayers([$layer1, new Color(), $layer2]));
        $this->assertSame([$layer1, $layer2], $icon->getLayers());

        $this->assertSame($icon, $icon->addLayer($layer3));
        $this->assertSame([$layer1, $layer2, $layer3], $icon->getLayers());
    }

    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $layer1 = new Layer();
        $layer1->setFileName('abc');
        $layer2 = new Layer();
        $layer2->setFileName('def');

        $icon = new Icon();
        $icon->setHash('ghi')
             ->addLayer($layer1)
             ->addLayer($layer2);

        $data = [
            'h' => 'ghi',
            'l' => [
                ['f' => 'abc'],
                ['f' => 'def'],
            ]
        ];

        return [
            [$icon, $data],
            [new Icon(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param Icon $icon
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Icon $icon, array $expectedData)
    {
        $data = $icon->writeData();
        $this->assertEquals($expectedData, $data);

        $newIcon = new Icon();
        $this->assertSame($newIcon, $newIcon->readData(new DataContainer($data)));
        $this->assertEquals($newIcon, $icon);
    }
}
