<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\Translations;
use FactorioItemBrowser\ExportData\Entity\Mod;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the mod class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Mod
 */
class ModTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $mod = new Mod();

        $this->assertSame('', $mod->name);
        $this->assertEquals(new Translations(), $mod->titles);
        $this->assertEquals(new Translations(), $mod->descriptions);
        $this->assertSame('', $mod->author);
        $this->assertSame('', $mod->version);
        $this->assertSame('', $mod->thumbnailId);
    }
}
