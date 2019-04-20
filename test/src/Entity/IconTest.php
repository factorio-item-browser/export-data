<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use FactorioItemBrowser\ExportData\Utils\EntityUtils;
use PHPUnit\Framework\MockObject\MockObject;
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
    public function testConstruct(): void
    {
        $icon = new Icon();
        $this->assertSame(Icon::DEFAULT_SIZE, $icon->getSize());
        $this->assertSame(Icon::DEFAULT_SIZE, $icon->getRenderedSize());
        $this->assertSame([], $icon->getLayers());
    }

    /**
     * Tests the cloning.
     * @covers ::__clone
     */
    public function testClone(): void
    {
        $layer = new Layer();
        $layer->setFileName('foo');

        $icon = new Icon();
        $icon->setSize(64)
             ->setRenderedSize(128)
             ->addLayer($layer);

        $clonedIcon = clone($icon);
        $icon->setSize(46)
             ->setRenderedSize(821);
        $layer->setFileName('oof');

        $this->assertSame(64, $clonedIcon->getSize());
        $this->assertSame(128, $clonedIcon->getRenderedSize());

        $layers = $clonedIcon->getLayers();
        $this->assertCount(1, $layers);
        $this->assertSame('foo', $layers[0]->getFileName());
    }

    /**
     * Tests setting and getting the size.
     * @covers ::setSize
     * @covers ::getSize
     */
    public function testSetAndGetSize(): void
    {
        $icon = new Icon();
        $this->assertSame($icon, $icon->setSize(64));
        $this->assertSame(64, $icon->getSize());
    }

    /**
     * Tests the setting and getting the rendered size.
     * @covers ::getRenderedSize
     * @covers ::setRenderedSize
     */
    public function testSetAndGetRenderedSize(): void
    {
        $renderedSize = 64;
        $icon = new Icon();

        $this->assertSame($icon, $icon->setRenderedSize($renderedSize));
        $this->assertSame($renderedSize, $icon->getRenderedSize());
    }
    
    /**
     * Tests setting, adding and getting the layers.
     * @covers ::setLayers
     * @covers ::getLayers
     * @covers ::addLayer
     */
    public function testSetAddAndGetLayers(): void
    {
        $layer1 = new Layer();
        $layer1->setFileName('abc');
        $layer2 = new Layer();
        $layer2->setFileName('def');
        $layer3 = new Layer();
        $layer3->setFileName('ghi');

        $icon = new Icon();
        $this->assertSame($icon, $icon->setLayers([$layer1, $layer2]));
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
        $icon->setSize(32)
             ->setRenderedSize(128)
             ->addLayer($layer1)
             ->addLayer($layer2);

        $data = [
            's' => 32,
            'r' => 128,
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
    public function testWriteAndReadData(Icon $icon, array $expectedData): void
    {
        $data = $icon->writeData();
        $this->assertEquals($expectedData, $data);

        $newIcon = new Icon();
        $this->assertSame($newIcon, $newIcon->readData(new DataContainer($data)));
        $this->assertEquals($newIcon, $icon);
    }

    /**
     * Tests the calculateHash method.
     * @covers ::calculateHash
     */
    public function testCalculateHash(): void
    {
        /* @var Layer|MockObject $layer1 */
        $layer1 = $this->getMockBuilder(Layer::class)
                       ->setMethods(['calculateHash'])
                       ->getMock();
        $layer1->expects($this->once())
               ->method('calculateHash')
               ->willReturn('abc');

        /* @var Layer|MockObject $layer2 */
        $layer2 = $this->getMockBuilder(Layer::class)
                       ->setMethods(['calculateHash'])
                       ->getMock();
        $layer2->expects($this->once())
               ->method('calculateHash')
               ->willReturn('def');

        $icon = new Icon();
        $icon->setSize(32)
             ->setRenderedSize(128)
             ->addLayer($layer1)
             ->addLayer($layer2);

        $expectedResult = EntityUtils::calculateHashOfArray([
            32,
            128,
            ['abc', 'def'],
        ]);

        $result = $icon->calculateHash();
        $this->assertSame($expectedResult, $result);
    }
}
