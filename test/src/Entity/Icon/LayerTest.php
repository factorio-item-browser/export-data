<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Entity\Icon\Color;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use FactorioItemBrowser\ExportData\Entity\Icon\Offset;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the layer class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @covers \FactorioItemBrowser\ExportData\Entity\Icon\Layer
 */
class LayerTest extends TestCase
{
    public function testConstruct(): void
    {
        $layer = new Layer();
        $this->assertSame('', $layer->fileName);
        $this->assertEquals(new Offset(), $layer->offset);
        $this->assertSame(1., $layer->scale);
        $this->assertSame(0, $layer->size);
        $this->assertEquals(new Color(), $layer->tint);
    }
}
