<?php

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
 * @coversDefaultClass FactorioItemBrowser\ExportData\Entity\Icon
 */
class IconTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $icon = new Icon();
        $this->assertEquals('', $icon->getIconHash());
        $this->assertEquals([], $icon->getLayers());
    }

    /**
     * Tests the cloning.
     */
    public function testClone()
    {
        $layer = new Layer();
        $layer->setFileName('foo');

        $icon = new Icon();
        $icon->setIconHash('bar')
             ->addLayer($layer);

        $clonedIcon = clone($icon);
        $icon->setIconHash('rab');
        $layer->setFileName('oof');

        $this->assertEquals('bar', $clonedIcon->getIconHash());
        $layers = $clonedIcon->getLayers();
        $this->assertEquals('foo', array_pop($layers)->getFileName());
    }

    /**
     * Tests setting and getting the icon hash.
     */
    public function testSetAndGetIconHash()
    {
        $icon = new Icon();
        $this->assertEquals($icon, $icon->setIconHash('foo'));
        $this->assertEquals('foo', $icon->getIconHash());
    }

    /**
     * Tests setting, adding and getting the layers.
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
        $this->assertEquals($icon, $icon->setLayers([$layer1, new Color(), $layer2]));
        $this->assertEquals([$layer1, $layer2], $icon->getLayers());

        $this->assertEquals($icon, $icon->addLayer($layer3));
        $this->assertEquals([$layer1, $layer2, $layer3], $icon->getLayers());
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
        $icon->setIconHash('ghi')
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
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Icon $icon, array $expectedData)
    {
        $data = $icon->writeData();
        $this->assertEquals($expectedData, $data);

        $newIcon = new Icon();
        $this->assertEquals($newIcon, $newIcon->readData(new DataContainer($data)));
        $this->assertEquals($newIcon, $icon);
    }
}
