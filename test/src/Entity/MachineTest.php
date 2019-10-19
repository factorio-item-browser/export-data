<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\LocalisedString;
use FactorioItemBrowser\ExportData\Entity\Machine;
use PHPUnit\Framework\MockObject\MockObject;
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
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $machine = new Machine();

        $this->assertSame('', $machine->getName());
        $this->assertSame([], $machine->getCraftingCategories());
        $this->assertSame(1., $machine->getCraftingSpeed());
        $this->assertSame(0, $machine->getNumberOfItemSlots());
        $this->assertSame(0, $machine->getNumberOfModuleSlots());
        $this->assertSame(0., $machine->getEnergyUsage());
        $this->assertSame('W', $machine->getEnergyUsageUnit());
        $this->assertSame('', $machine->getIconId());

        // Asserted through type-hints
        $machine->getLabels();
        $machine->getDescriptions();
    }

    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $machine = new Machine();

        $this->assertSame($machine, $machine->setName($name));
        $this->assertSame($name, $machine->getName());
    }

    /**
     * Tests setting and getting the labels.
     * @covers ::setLabels
     * @covers ::getLabels
     */
    public function testSetAndGetLabels(): void
    {
        /* @var LocalisedString&MockObject $labels */
        $labels = $this->createMock(LocalisedString::class);
        $machine = new Machine();

        $this->assertSame($machine, $machine->setLabels($labels));
        $this->assertSame($labels, $machine->getLabels());
    }

    /**
     * Tests setting and getting the descriptions.
     * @covers ::setDescriptions
     * @covers ::getDescriptions
     */
    public function testSetAndGetDescriptions(): void
    {
        /* @var LocalisedString&MockObject $descriptions */
        $descriptions = $this->createMock(LocalisedString::class);
        $machine = new Machine();

        $this->assertSame($machine, $machine->setDescriptions($descriptions));
        $this->assertSame($descriptions, $machine->getDescriptions());
    }

    /**
     * Tests setting, adding and getting the crafting categories.
     * @covers ::setCraftingCategories
     * @covers ::getCraftingCategories
     * @covers ::addCraftingCategory
     */
    public function testSetAddAndGetCraftingCategories(): void
    {
        $machine = new Machine();

        $this->assertSame($machine, $machine->setCraftingCategories(['abc', 'def']));
        $this->assertSame(['abc', 'def'], $machine->getCraftingCategories());

        $this->assertSame($machine, $machine->addCraftingCategory('ghi'));
        $this->assertSame(['abc', 'def', 'ghi'], $machine->getCraftingCategories());
    }

    /**
     * Tests the setting and getting the crafting speed.
     * @covers ::getCraftingSpeed
     * @covers ::setCraftingSpeed
     */
    public function testSetAndGetCraftingSpeed(): void
    {
        $craftingSpeed = 13.37;
        $machine = new Machine();

        $this->assertSame($machine, $machine->setCraftingSpeed($craftingSpeed));
        $this->assertSame($craftingSpeed, $machine->getCraftingSpeed());
    }

    /**
     * Tests the setting and getting the number of item slots.
     * @covers ::getNumberOfItemSlots
     * @covers ::setNumberOfItemSlots
     */
    public function testSetAndGetNumberOfItemSlots(): void
    {
        $numberOfItemSlots = 42;
        $machine = new Machine();

        $this->assertSame($machine, $machine->setNumberOfItemSlots($numberOfItemSlots));
        $this->assertSame($numberOfItemSlots, $machine->getNumberOfItemSlots());
    }

    /**
     * Tests the setting and getting the number of fluid input slots.
     * @covers ::getNumberOfFluidInputSlots
     * @covers ::setNumberOfFluidInputSlots
     */
    public function testSetAndGetNumberOfFluidInputSlots(): void
    {
        $numberOfFluidInputSlots = 42;
        $machine = new Machine();

        $this->assertSame($machine, $machine->setNumberOfFluidInputSlots($numberOfFluidInputSlots));
        $this->assertSame($numberOfFluidInputSlots, $machine->getNumberOfFluidInputSlots());
    }

    /**
     * Tests the setting and getting the number of fluid output slots.
     * @covers ::getNumberOfFluidOutputSlots
     * @covers ::setNumberOfFluidOutputSlots
     */
    public function testSetAndGetNumberOfFluidOutputSlots(): void
    {
        $numberOfFluidOutputSlots = 42;
        $machine = new Machine();

        $this->assertSame($machine, $machine->setNumberOfFluidOutputSlots($numberOfFluidOutputSlots));
        $this->assertSame($numberOfFluidOutputSlots, $machine->getNumberOfFluidOutputSlots());
    }

    /**
     * Tests the setting and getting the number of module slots.
     * @covers ::getNumberOfModuleSlots
     * @covers ::setNumberOfModuleSlots
     */
    public function testSetAndGetNumberOfModuleSlots(): void
    {
        $numberOfModuleSlots = 42;
        $machine = new Machine();

        $this->assertSame($machine, $machine->setNumberOfModuleSlots($numberOfModuleSlots));
        $this->assertSame($numberOfModuleSlots, $machine->getNumberOfModuleSlots());
    }

    /**
     * Tests the setting and getting the energy usage.
     * @covers ::getEnergyUsage
     * @covers ::setEnergyUsage
     */
    public function testSetAndGetEnergyUsage(): void
    {
        $energyUsage = 13.37;
        $machine = new Machine();

        $this->assertSame($machine, $machine->setEnergyUsage($energyUsage));
        $this->assertSame($energyUsage, $machine->getEnergyUsage());
    }

    /**
     * Tests the setting and getting the energy usage unit.
     * @covers ::getEnergyUsageUnit
     * @covers ::setEnergyUsageUnit
     */
    public function testSetAndGetEnergyUsageUnit(): void
    {
        $energyUsageUnit = 'abc';
        $machine = new Machine();

        $this->assertSame($machine, $machine->setEnergyUsageUnit($energyUsageUnit));
        $this->assertSame($energyUsageUnit, $machine->getEnergyUsageUnit());
    }

    /**
     * Tests the setting and getting the icon id.
     * @covers ::getIconId
     * @covers ::setIconId
     */
    public function testSetAndGetIconId(): void
    {
        $iconId = 'abc';
        $machine = new Machine();

        $this->assertSame($machine, $machine->setIconId($iconId));
        $this->assertSame($iconId, $machine->getIconId());
    }
}
