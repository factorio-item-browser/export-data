<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\LocalisedString;
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
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $machine = new Machine();

        $this->assertEquals('', $machine->getName());
        $this->assertInstanceOf(LocalisedString::class, $machine->getLabels());
        $this->assertInstanceOf(LocalisedString::class, $machine->getDescriptions());
        $this->assertEquals([], $machine->getCraftingCategories());
        $this->assertEquals(1., $machine->getCraftingSpeed());
        $this->assertEquals(0, $machine->getNumberOfIngredientSlots());
        $this->assertEquals(0, $machine->getNumberOfModuleSlots());
        $this->assertEquals(0, $machine->getEnergyUsage());
        $this->assertEquals('', $machine->getIconHash());
    }

    /**
     * Tests the cloning.
     * @covers ::__clone
     */
    public function testClone()
    {
        $machine = new Machine();
        $machine->setName('abc')
                ->setCraftingCategories(['def', 'ghi'])
                ->setCraftingSpeed(13.37)
                ->setNumberOfIngredientSlots(42)
                ->setNumberOfModuleSlots(21)
                ->setEnergyUsage(1337)
                ->setIconHash('jkl');
        $machine->getLabels()->setTranslation('en', 'mno');
        $machine->getDescriptions()->setTranslation('en', 'pqr');

        $clonedMachine = clone($machine);
        $machine->setName('cba')
                ->setCraftingCategories(['fed', 'ihg'])
                ->setCraftingSpeed(73.31)
                ->setNumberOfIngredientSlots(24)
                ->setNumberOfModuleSlots(12)
                ->setEnergyUsage(7331)
                ->setIconHash('lkj');
        $machine->getLabels()->setTranslation('en', 'onm');
        $machine->getDescriptions()->setTranslation('en', 'rqp');

        $this->assertEquals('abc', $clonedMachine->getName());
        $this->assertEquals(['def', 'ghi'], $clonedMachine->getCraftingCategories());
        $this->assertEquals(13.37, $clonedMachine->getCraftingSpeed());
        $this->assertEquals(42, $clonedMachine->getNumberOfIngredientSlots());
        $this->assertEquals(21, $clonedMachine->getNumberOfModuleSlots());
        $this->assertEquals(1337, $clonedMachine->getEnergyUsage());
        $this->assertEquals('jkl', $clonedMachine->getIconHash());
        $this->assertEquals('mno', $clonedMachine->getLabels()->getTranslation('en'));
        $this->assertEquals('pqr', $clonedMachine->getDescriptions()->getTranslation('en'));
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName()
    {
        $machine = new Machine();
        $this->assertEquals($machine, $machine->setName('foo'));
        $this->assertEquals('foo', $machine->getName());
    }

    /**
     * Tests setting and getting the labels.
     * @covers ::setLabels
     * @covers ::getLabels
     */
    public function testSetAndGetLabels()
    {
        $labels = new LocalisedString();
        $labels->setTranslation('en', 'foo');

        $machine = new Machine();
        $this->assertEquals($machine, $machine->setLabels($labels));
        $this->assertEquals($labels, $machine->getLabels());
    }

    /**
     * Tests setting and getting the descriptions.
     * @covers ::setDescriptions
     * @covers ::getDescriptions
     */
    public function testSetAndGetDescriptions()
    {
        $descriptions = new LocalisedString();
        $descriptions->setTranslation('en', 'foo');

        $machine = new Machine();
        $this->assertEquals($machine, $machine->setDescriptions($descriptions));
        $this->assertEquals($descriptions, $machine->getDescriptions());
    }

    /**
     * Tests setting, adding and getting the crafting categories.
     * @covers ::setCraftingCategories
     * @covers ::getCraftingCategories
     * @covers ::addCraftingCategory
     */
    public function testSetAddAndGetCraftingCategorys()
    {
        $machine = new Machine();
        $this->assertEquals($machine, $machine->setCraftingCategories(['abc', 'def']));
        $this->assertEquals(['abc', 'def'], $machine->getCraftingCategories());

        $this->assertEquals($machine, $machine->addCraftingCategory('ghi'));
        $this->assertEquals(['abc', 'def', 'ghi'], $machine->getCraftingCategories());
    }

    /**
     * Tests setting and getting the crafting speed.
     * @covers ::setCraftingSpeed
     * @covers ::getCraftingSpeed
     */
    public function testSetAndGetCraftingSpeed()
    {
        $machine = new Machine();
        $this->assertEquals($machine, $machine->setCraftingSpeed(13.37));
        $this->assertEquals(13.37, $machine->getCraftingSpeed());
    }

    /**
     * Tests setting and getting the number of ingredient slots.
     * @covers ::setNumberOfIngredientSlots
     * @covers ::getNumberOfIngredientSlots
     */
    public function testSetAndGetNumberOfIngredientSlots()
    {
        $machine = new Machine();
        $this->assertEquals($machine, $machine->setNumberOfIngredientSlots(42));
        $this->assertEquals(42, $machine->getNumberOfIngredientSlots());
    }

    /**
     * Tests setting and getting the number of module slots.
     * @covers ::setNumberOfModuleSlots
     * @covers ::getNumberOfModuleSlots
     */
    public function testSetAndGetNumberOfModuleSlots()
    {
        $machine = new Machine();
        $this->assertEquals($machine, $machine->setNumberOfModuleSlots(42));
        $this->assertEquals(42, $machine->getNumberOfModuleSlots());
    }

    /**
     * Tests setting and getting the energy usage.
     * @covers ::setEnergyUsage
     * @covers ::getEnergyUsage
     */
    public function testSetAndGetEnergyUsage()
    {
        $machine = new Machine();
        $this->assertEquals($machine, $machine->setEnergyUsage(42));
        $this->assertEquals(42, $machine->getEnergyUsage());
    }

    /**
     * Tests setting and getting the icon hash.
     * @covers ::setIconHash
     * @covers ::getIconHash
     */
    public function testSetAndGetIconHash()
    {
        $machine = new Machine();
        $this->assertEquals($machine, $machine->setIconHash('foo'));
        $this->assertEquals('foo', $machine->getIconHash());
    }


    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $machine = new Machine();
        $machine->setName('abc')
                ->setCraftingCategories(['def', 'ghi'])
                ->setCraftingSpeed(13.37)
                ->setNumberOfIngredientSlots(42)
                ->setNumberOfModuleSlots(21)
                ->setEnergyUsage(1337)
                ->setIconHash('jkl');
        $machine->getLabels()->setTranslation('en', 'mno');
        $machine->getDescriptions()->setTranslation('en', 'pqr');

        $data = [
            'n' => 'abc',
            'l' => [
                'en' => 'mno'
            ],
            'd' => [
                'en' => 'pqr'
            ],
            'c' => ['def', 'ghi'],
            's' => 13.37,
            'i' => 42,
            'm' => 21,
            'e' => 1337,
            'o' => 'jkl'
        ];

        return [
            [$machine, $data],
            [new Machine(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param Machine $machine
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Machine $machine, array $expectedData)
    {
        $data = $machine->writeData();
        $this->assertEquals($expectedData, $data);

        $newMachine = new Machine();
        $this->assertEquals($newMachine, $newMachine->readData(new DataContainer($data)));
        $this->assertEquals($newMachine, $machine);
    }
}
