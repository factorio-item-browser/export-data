<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
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

        $this->assertSame('', $icon->getHash());
        $this->assertSame(0, $icon->getSize());
        $this->assertSame(0, $icon->getRenderedSize());
        $this->assertSame([], $icon->getLayers());
    }

    /**
     * Tests the setting and getting the hash.
     * @covers ::getHash
     * @covers ::setHash
     */
    public function testSetAndGetHash(): void
    {
        $hash = 'abc';
        $icon = new Icon();

        $this->assertSame($icon, $icon->setHash($hash));
        $this->assertSame($hash, $icon->getHash());
    }

    /**
     * Tests the setting and getting the size.
     * @covers ::getSize
     * @covers ::setSize
     */
    public function testSetAndGetSize(): void
    {
        $size = 42;
        $icon = new Icon();

        $this->assertSame($icon, $icon->setSize($size));
        $this->assertSame($size, $icon->getSize());
    }

    /**
     * Tests the setting and getting the rendered size.
     * @covers ::getRenderedSize
     * @covers ::setRenderedSize
     */
    public function testSetAndGetRenderedSize(): void
    {
        $renderedSize = 42;
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
        /* @var Layer&MockObject $layer1 */
        $layer1 = $this->createMock(Layer::class);
        /* @var Layer&MockObject $layer2 */
        $layer2 = $this->createMock(Layer::class);
        /* @var Layer&MockObject $layer3 */
        $layer3 = $this->createMock(Layer::class);

        $icon = new Icon();
        $this->assertSame($icon, $icon->setLayers([$layer1, $layer2]));
        $this->assertSame([$layer1, $layer2], $icon->getLayers());

        $this->assertSame($icon, $icon->addLayer($layer3));
        $this->assertSame([$layer1, $layer2, $layer3], $icon->getLayers());
    }
}
