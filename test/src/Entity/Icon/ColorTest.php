<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Entity\Icon\Color;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the color class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Icon\Color
 */
class ColorTest extends TestCase
{
    /**
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $color = new Color();

        $this->assertSame(1., $color->red);
        $this->assertSame(1., $color->green);
        $this->assertSame(1., $color->blue);
        $this->assertSame(1., $color->alpha);
    }
}
