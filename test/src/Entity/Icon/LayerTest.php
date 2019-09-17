<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Entity\Icon\Color;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
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
        $this->assertSame(0, $layer->getOffsetX());
        $this->assertSame(0, $layer->getOffsetY());
        $this->assertSame(1., $layer->getScale());

        // Asserted through type-hints
        $layer->getTintColor();
    }

    /**
     * Tests the setting and getting the file name.
     * @covers ::getFileName
     * @covers ::setFileName
     */
    public function testSetAndGetFileName(): void
    {
        $fileName = 'abc';
        $layer = new Layer();

        $this->assertSame($layer, $layer->setFileName($fileName));
        $this->assertSame($fileName, $layer->getFileName());
    }

    /**
     * Tests the setting and getting the tint color.
     * @covers ::getTintColor
     * @covers ::setTintColor
     */
    public function testSetAndGetTintColor(): void
    {
        /* @var Color&MockObject $tintColor */
        $tintColor = $this->createMock(Color::class);
        $layer = new Layer();

        $this->assertSame($layer, $layer->setTintColor($tintColor));
        $this->assertSame($tintColor, $layer->getTintColor());
    }

    /**
     * Tests the setting and getting the offset x.
     * @covers ::getOffsetX
     * @covers ::setOffsetX
     */
    public function testSetAndGetOffsetX(): void
    {
        $offsetX = 42;
        $layer = new Layer();

        $this->assertSame($layer, $layer->setOffsetX($offsetX));
        $this->assertSame($offsetX, $layer->getOffsetX());
    }

    /**
     * Tests the setting and getting the offset y.
     * @covers ::getOffsetY
     * @covers ::setOffsetY
     */
    public function testSetAndGetOffsetY(): void
    {
        $offsetY = 42;
        $layer = new Layer();

        $this->assertSame($layer, $layer->setOffsetY($offsetY));
        $this->assertSame($offsetY, $layer->getOffsetY());
    }

    /**
     * Tests the setting and getting the scale.
     * @covers ::getScale
     * @covers ::setScale
     */
    public function testSetAndGetScale(): void
    {
        $scale = 13.37;
        $layer = new Layer();

        $this->assertSame($layer, $layer->setScale($scale));
        $this->assertSame($scale, $layer->getScale());
    }
}
