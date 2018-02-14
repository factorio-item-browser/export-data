<?php

namespace FactorioItemBrowserTest\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Entity\Icon\Color;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the color class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass FactorioItemBrowser\ExportData\Entity\Icon\Color
 */
class ColorTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $color = new Color();
        $this->assertEquals(1., $color->getRed());
        $this->assertEquals(1., $color->getGreen());
        $this->assertEquals(1., $color->getBlue());
        $this->assertEquals(1., $color->getAlpha());
    }

    /**
     * Tests setting and getting the red.
     */
    public function testSetAndGetRed()
    {
        $color = new Color();
        $this->assertEquals($color, $color->setRed(0.25));
        $this->assertEquals(0.25, $color->getRed());
        $this->assertEquals(64, $color->getRed(256));

        $this->assertEquals($color, $color->setRed(64, 256));
        $this->assertEquals(0.25, $color->getRed());
        $this->assertEquals(64, $color->getRed(256));
    }

    /**
     * Tests setting and getting the green.
     */
    public function testSetAndGetGreen()
    {
        $color = new Color();
        $this->assertEquals($color, $color->setGreen(0.25));
        $this->assertEquals(0.25, $color->getGreen());
        $this->assertEquals(64, $color->getGreen(256));

        $this->assertEquals($color, $color->setGreen(64, 256));
        $this->assertEquals(0.25, $color->getGreen());
        $this->assertEquals(64, $color->getGreen(256));
    }

    /**
     * Tests setting and getting the blue.
     */
    public function testSetAndGetBlue()
    {
        $color = new Color();
        $this->assertEquals($color, $color->setBlue(0.25));
        $this->assertEquals(0.25, $color->getBlue());
        $this->assertEquals(64, $color->getBlue(256));

        $this->assertEquals($color, $color->setBlue(64, 256));
        $this->assertEquals(0.25, $color->getBlue());
        $this->assertEquals(64, $color->getBlue(256));
    }

    /**
     * Tests setting and getting the alpha.
     */
    public function testSetAndGetAlpha()
    {
        $color = new Color();
        $this->assertEquals($color, $color->setAlpha(0.25));
        $this->assertEquals(0.25, $color->getAlpha());
        $this->assertEquals(64, $color->getAlpha(256));

        $this->assertEquals($color, $color->setAlpha(64, 256));
        $this->assertEquals(0.25, $color->getAlpha());
        $this->assertEquals(64, $color->getAlpha(256));
    }
}
