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
        $recipe = new Technology();

        $this->assertSame('', $recipe->name);
        $this->assertSame('', $recipe->mode);
        $this->assertSame([], $recipe->prerequisites);
        $this->assertSame([], $recipe->researchIngredients);
        $this->assertSame(0, $recipe->researchCount);
        $this->assertSame(0., $recipe->researchTime);
        $this->assertSame('', $recipe->iconId);
    }
}
