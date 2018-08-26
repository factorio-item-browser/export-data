<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Icon;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Icon\Color;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use FactorioItemBrowser\ExportData\Utils\HashUtils;
use PHPUnit\Framework\MockObject\MockObject;
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
    public function testConstruct(): void
    {
        $layer = new Layer();
        $this->assertSame('', $layer->getFileName());
        $this->assertEquals(new Color(), $layer->getTintColor());
        $this->assertSame(0, $layer->getOffsetX());
        $this->assertSame(0, $layer->getOffsetY());
        $this->assertSame(1., $layer->getScale());
    }

    /**
     * Tests the cloning.
     * @covers ::__clone
     */
    public function testClone(): void
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

        $this->assertSame('foo', $clonedLayer->getFileName());
        $this->assertSame(42, $clonedLayer->getOffsetX());
        $this->assertSame(21, $clonedLayer->getOffsetY());
        $this->assertSame(13.37, $clonedLayer->getScale());
        $this->assertSame(4.2, $clonedLayer->getTintColor()->getAlpha());
    }

    /**
     * Tests setting and getting the file name.
     * @covers ::setFileName
     * @covers ::getFileName
     */
    public function testSetAndGetFileName(): void
    {
        $layer = new layer();
        $this->assertSame($layer, $layer->setFileName('foo'));
        $this->assertSame('foo', $layer->getFileName());
    }

    /**
     * Tests setting and getting the tint color.
     * @covers ::setTintColor
     * @covers ::getTintColor
     */
    public function testSetAndGetTintColor(): void
    {
        $color = new Color();
        $color->setAlpha(0.42);

        $layer = new layer();
        $this->assertSame($layer, $layer->setTintColor($color));
        $this->assertSame($color, $layer->getTintColor());
    }

    /**
     * Tests setting and getting the offset X.
     * @covers ::setOffsetX
     * @covers ::getOffsetX
     */
    public function testSetAndGetOffsetX(): void
    {
        $layer = new layer();
        $this->assertSame($layer, $layer->setOffsetX(42));
        $this->assertSame(42, $layer->getOffsetX());
    }

    /**
     * Tests setting and getting the offset Y.
     * @covers ::setOffsetY
     * @covers ::getOffsetY
     */
    public function testSetAndGetOffsetY(): void
    {
        $layer = new layer();
        $this->assertSame($layer, $layer->setOffsetY(42));
        $this->assertSame(42, $layer->getOffsetY());
    }

    /**
     * Tests setting and getting the scale.
     * @covers ::setScale
     * @covers ::getScale
     */
    public function testSetAndGetScale(): void
    {
        $layer = new layer();
        $this->assertSame($layer, $layer->setScale(4.2));
        $this->assertSame(4.2, $layer->getScale());
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
    public function testWriteAndReadData(Layer $layer, array $expectedData): void
    {
        $data = $layer->writeData();
        $this->assertEquals($expectedData, $data);

        $newLayer = new Layer();
        $this->assertSame($newLayer, $newLayer->readData(new DataContainer($data)));
        $this->assertEquals($newLayer, $layer);
    }

    /**
     * Tests the calculateHash method.
     * @covers ::calculateHash
     */
    public function testCalculateHash(): void
    {
        /* @var Color|MockObject $tintColor */
        $tintColor = $this->getMockBuilder(Color::class)
                          ->setMethods(['calculateHash'])
                          ->getMock();
        $tintColor->expects($this->once())
                  ->method('calculateHash')
                  ->willReturn('def');

        $layer = new Layer();
        $layer->setFileName('abc')
              ->setTintColor($tintColor)
              ->setOffsetX(42)
              ->setOffsetY(21)
              ->setScale(13.37);

        $expectedResult = HashUtils::calculateHashOfArray([
            'abc',
            'def',
            42,
            21,
            13.37
        ]);

        $result = $layer->calculateHash();
        $this->assertSame($expectedResult, $result);
    }
}
