<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Icon;

use FactorioItemBrowser\ExportData\Entity\Icon\Offset;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Offset class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Icon\Offset
 */
class OffsetTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $offset = new Offset();

        $this->assertSame(0, $offset->getX());
        $this->assertSame(0, $offset->getY());
    }

    /**
     * Tests the setting and getting the x.
     * @covers ::getX
     * @covers ::setX
     */
    public function testSetAndGetX(): void
    {
        $x = 42;
        $offset = new Offset();

        $this->assertSame($offset, $offset->setX($x));
        $this->assertSame($x, $offset->getX());
    }

    /**
     * Tests the setting and getting the y.
     * @covers ::getY
     * @covers ::setY
     */
    public function testSetAndGetY(): void
    {
        $y = 42;
        $offset = new Offset();

        $this->assertSame($offset, $offset->setY($y));
        $this->assertSame($y, $offset->getY());
    }
}
