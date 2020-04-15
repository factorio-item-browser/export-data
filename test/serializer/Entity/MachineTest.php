<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Machine;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

/**
 * The test of the serializing the machine class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Machine
 */
class MachineTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $machine = new Machine();
        $machine->setName('abc')
                ->setCraftingCategories(['def', 'ghi'])
                ->setCraftingSpeed(13.37)
                ->setNumberOfItemSlots(12)
                ->setNumberOfFluidInputSlots(34)
                ->setNumberOfFluidOutputSlots(56)
                ->setNumberOfModuleSlots(78)
                ->setEnergyUsage(2.1)
                ->setEnergyUsageUnit('jkl')
                ->setIconId('mno');
        $machine->getLabels()->addTranslation('pqr', 'stu');
        $machine->getDescriptions()->addTranslation('vwx', 'yza');

        return $machine;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'name' => 'abc',
            'craftingCategories' => ['def', 'ghi'],
            'craftingSpeed' => 13.37,
            'numberOfItemSlots' => 12,
            'numberOfFluidInputSlots' => 34,
            'numberOfFluidOutputSlots' => 56,
            'numberOfModuleSlots' => 78,
            'energyUsage' => 2.1,
            'energyUsageUnit' => 'jkl',
            'iconId' => 'mno',
            'labels' => [
                'pqr' => 'stu',
            ],
            'descriptions' => [
                'vwx' => 'yza',
            ],
        ];
    }
}
