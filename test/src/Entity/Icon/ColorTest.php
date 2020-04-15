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
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $color = new Color();

        $this->assertSame(1., $color->getRed());
        $this->assertSame(1., $color->getGreen());
        $this->assertSame(1., $color->getBlue());
        $this->assertSame(1., $color->getAlpha());
    }

    /**
     * Tests setting and getting the red.
     * @covers ::setRed
     * @covers ::getRed
     * @covers ::<protected>
     */
    public function testSetAndGetRed(): void
    {
        $color = new Color();

        $this->assertSame($color, $color->setRed(0.25));
        $this->assertSame(0.25, $color->getRed());
        $this->assertSame(64., $color->getRed(256.));

        $this->assertSame($color, $color->setRed(64., 256.));
        $this->assertSame(0.25, $color->getRed());
        $this->assertSame(64., $color->getRed(256.));
    }

    /**
     * Tests setting and getting the green.
     * @covers ::setGreen
     * @covers ::getGreen
     * @covers ::<protected>
     */
    public function testSetAndGetGreen(): void
    {
        $color = new Color();

        $this->assertSame($color, $color->setGreen(0.25));
        $this->assertSame(0.25, $color->getGreen());
        $this->assertSame(64., $color->getGreen(256.));

        $this->assertSame($color, $color->setGreen(64., 256.));
        $this->assertSame(0.25, $color->getGreen());
        $this->assertSame(64., $color->getGreen(256.));
    }

    /**
     * Tests setting and getting the blue.
     * @covers ::setBlue
     * @covers ::getBlue
     * @covers ::<protected>
     */
    public function testSetAndGetBlue(): void
    {
        $color = new Color();

        $this->assertSame($color, $color->setBlue(0.25));
        $this->assertSame(0.25, $color->getBlue());
        $this->assertSame(64., $color->getBlue(256.));

        $this->assertSame($color, $color->setBlue(64., 256.));
        $this->assertSame(0.25, $color->getBlue());
        $this->assertSame(64., $color->getBlue(256.));
    }

    /**
     * Tests setting and getting the alpha.
     * @covers ::setAlpha
     * @covers ::getAlpha
     * @covers ::<protected>
     */
    public function testSetAndGetAlpha(): void
    {
        $color = new Color();

        $this->assertSame($color, $color->setAlpha(0.25));
        $this->assertSame(0.25, $color->getAlpha());
        $this->assertSame(64., $color->getAlpha(256.));

        $this->assertSame($color, $color->setAlpha(64., 256.));
        $this->assertSame(0.25, $color->getAlpha());
        $this->assertSame(64., $color->getAlpha(256.));
    }
}
