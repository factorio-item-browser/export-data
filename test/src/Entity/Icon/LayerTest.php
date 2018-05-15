<?php

namespace FactorioItemBrowserTest\ExportData\Entity\Icon;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Icon\Color;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the layer class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Icon\Layer
 */
class LayerTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $layer = new Layer();
        $this->assertEquals('', $layer->getFileName());
        $this->assertInstanceOf(Color::class, $layer->getTintColor());
        $this->assertEquals(0, $layer->getOffsetX());
        $this->assertEquals(0, $layer->getOffsetY());
        $this->assertEquals(1., $layer->getScale());
    }

    /**
     * Tests the cloning.
     * @covers ::__clone
     */
    public function testClone()
    {
        $layer = new Layer();
        $layer->setFileName('foo')
              ->setOffsetX(42)
              ->setOffsetY(21)
              ->setScale(13.37);
        $layer->getTintColor()->setAlpha(4.2);

        $clonedLayer = clone($layer);
        $layer->setFileName('oof')
              ->setOffsetX(24)
              ->setOffsetY(12)
              ->setScale(73.31);
        $layer->getTintColor()->setAlpha(2.4);

        $this->assertEquals('foo', $clonedLayer->getFileName());
        $this->assertEquals(42, $clonedLayer->getOffsetX());
        $this->assertEquals(21, $clonedLayer->getOffsetY());
        $this->assertEquals(13.37, $clonedLayer->getScale());
        $this->assertEquals(4.2, $clonedLayer->getTintColor()->getAlpha());
    }

    /**
     * Tests setting and getting the file name.
     * @covers ::setFileName
     * @covers ::getFileName
     */
    public function testSetAndGetFileName()
    {
        $layer = new layer();
        $this->assertEquals($layer, $layer->setFileName('foo'));
        $this->assertEquals('foo', $layer->getFileName());
    }

    /**
     * Tests setting and getting the tint color.
     * @covers ::setTintColor
     * @covers ::getTintColor
     */
    public function testSetAndGetTintColor()
    {
        $color = new Color();
        $color->setAlpha(0.42);

        $layer = new layer();
        $this->assertEquals($layer, $layer->setTintColor($color));
        $this->assertEquals($color, $layer->getTintColor());
    }

    /**
     * Tests setting and getting the offset X.
     * @covers ::setOffsetX
     * @covers ::getOffsetX
     */
    public function testSetAndGetOffsetX()
    {
        $layer = new layer();
        $this->assertEquals($layer, $layer->setOffsetX(42));
        $this->assertEquals(42, $layer->getOffsetX());
    }

    /**
     * Tests setting and getting the offset Y.
     * @covers ::setOffsetY
     * @covers ::getOffsetY
     */
    public function testSetAndGetOffsetY()
    {
        $layer = new layer();
        $this->assertEquals($layer, $layer->setOffsetY(42));
        $this->assertEquals(42, $layer->getOffsetY());
    }

    /**
     * Tests setting and getting the scale.
     * @covers ::setScale
     * @covers ::getScale
     */
    public function testSetAndGetScale()
    {
        $layer = new layer();
        $this->assertEquals($layer, $layer->setScale(4.2));
        $this->assertEquals(4.2, $layer->getScale());
    }

    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $layer = new Layer();
        $layer->setFileName('abc')
              ->setOffsetX(42)
              ->setOffsetY(21)
              ->setScale(13.37);
        $layer->getTintColor()->setRed(0.2);

        $data = [
            'f' => 'abc',
            'c' => [
                'r' => 0.2
            ],
            'x' => 42,
            'y' => 21,
            's' => 13.37
        ];

        return [
            [$layer, $data],
            [new Layer(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param Layer $layer
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Layer $layer, array $expectedData)
    {
        $data = $layer->writeData();
        $this->assertEquals($expectedData, $data);

        $newLayer = new Layer();
        $this->assertEquals($newLayer, $newLayer->readData(new DataContainer($data)));
        $this->assertEquals($newLayer, $layer);
    }
}
