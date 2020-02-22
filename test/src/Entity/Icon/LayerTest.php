<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Entity\Icon\Color;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use FactorioItemBrowser\ExportData\Entity\Icon\Offset;
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
        $this->assertSame(1., $layer->getScale());
        $this->assertSame(0, $layer->getSize());


        // Asserted through type-hints
        $layer->getTint();
        $layer->getOffset();
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
     * Tests the setting and getting the offset.
     * @covers ::getOffset
     * @covers ::setOffset
     */
    public function testSetAndGetOffset(): void
    {
        /* @var Offset&MockObject $offset */
        $offset = $this->createMock(Offset::class);
        $layer = new Layer();

        $this->assertSame($layer, $layer->setOffset($offset));
        $this->assertSame($offset, $layer->getOffset());
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

    /**
     * Tests the setting and getting the size.
     * @covers ::getSize
     * @covers ::setSize
     */
    public function testSetAndGetSize(): void
    {
        $size = 42;
        $layer = new Layer();

        $this->assertSame($layer, $layer->setSize($size));
        $this->assertSame($size, $layer->getSize());
    }

    /**
     * Tests the setting and getting the tint.
     * @covers ::getTint
     * @covers ::setTint
     */
    public function testSetAndGetTint(): void
    {
        /* @var Color&MockObject $tint */
        $tint = $this->createMock(Color::class);
        $layer = new Layer();

        $this->assertSame($layer, $layer->setTint($tint));
        $this->assertSame($tint, $layer->getTint());
    }
}
