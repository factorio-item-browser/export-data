<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\Translations;
use FactorioItemBrowser\ExportData\Entity\Machine;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the machine class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Machine
 */
class MachineTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $machine = new Machine();

        $this->assertSame('', $machine->name);
        $this->assertEquals(new Translations(), $machine->labels);
        $this->assertEquals(new Translations(), $machine->descriptions);
        $this->assertSame([], $machine->craftingCategories);
        $this->assertSame(1., $machine->craftingSpeed);
        $this->assertSame(0, $machine->numberOfItemSlots);
        $this->assertSame(0, $machine->numberOfFluidInputSlots);
        $this->assertSame(0, $machine->numberOfFluidOutputSlots);
        $this->assertSame(0, $machine->numberOfModuleSlots);
        $this->assertSame(0., $machine->energyUsage);
        $this->assertSame('W', $machine->energyUsageUnit);
        $this->assertSame('', $machine->iconId);
    }
}
