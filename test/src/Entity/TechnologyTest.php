<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Technology;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Technology class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\Entity\Technology
 */
class TechnologyTest extends TestCase
{
    public function testConstruct(): void
    {
        $instance = new Technology();

        $this->assertSame('', $instance->name);
        $this->assertSame('', $instance->mode);
        $this->assertSame([], $instance->prerequisites);
        $this->assertSame([], $instance->researchIngredients);
        $this->assertSame(0, $instance->researchCount);
        $this->assertSame('', $instance->researchCountFormula);
        $this->assertSame(0., $instance->researchTime);
        $this->assertSame(0, $instance->level);
        $this->assertSame(0, $instance->maxLevel);
        $this->assertSame('', $instance->iconId);
    }
}
