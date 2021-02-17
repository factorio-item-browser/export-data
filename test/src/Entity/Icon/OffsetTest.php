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
 * @covers \FactorioItemBrowser\ExportData\Entity\Icon\Offset
 */
class OffsetTest extends TestCase
{
    public function testConstruct(): void
    {
        $offset = new Offset();

        $this->assertSame(0, $offset->x);
        $this->assertSame(0, $offset->y);
    }
}
