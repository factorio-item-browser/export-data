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
        $machine->name = 'abc';
        $machine->craftingCategories = ['def', 'ghi'];
        $machine->craftingSpeed = 13.37;
        $machine->numberOfItemSlots = 12;
        $machine->numberOfFluidInputSlots = 34;
        $machine->numberOfFluidOutputSlots = 56;
        $machine->numberOfModuleSlots = 78;
        $machine->energyUsage = 2.1;
        $machine->energyUsageUnit = 'jkl';
        $machine->iconId = 'mno';
        $machine->labels->set('pqr', 'stu');
        $machine->descriptions->set('vwx', 'yza');

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
