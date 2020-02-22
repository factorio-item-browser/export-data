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

        $this->assertSame('', $icon->getId());
        $this->assertSame(0, $icon->getSize());
        $this->assertSame([], $icon->getLayers());
    }

    /**
     * Tests the setting and getting the id.
     * @covers ::getId
     * @covers ::setId
     */
    public function testSetAndGetId(): void
    {
        $id = 'abc';
        $icon = new Icon();

        $this->assertSame($icon, $icon->setId($id));
        $this->assertSame($id, $icon->getId());
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
