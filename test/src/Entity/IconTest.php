<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Icon;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the icon class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @covers \FactorioItemBrowser\ExportData\Entity\Icon
 */
class IconTest extends TestCase
{
    public function testConstruct(): void
    {
        $icon = new Icon();

        $this->assertSame('', $icon->id);
        $this->assertSame(0, $icon->size);
        $this->assertSame([], $icon->layers);
    }
}
