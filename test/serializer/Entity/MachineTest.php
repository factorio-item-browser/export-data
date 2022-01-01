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
 */
class MachineTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $machine = new Machine();
        $machine->name = 'abc';
        $machine->craftingCategories = ['def', 'ghi'];
        $machine->resourceCategories = ['hij', 'klm'];
        $machine->speed = 13.37;
        $machine->numberOfItemSlots = 12;
        $machine->numberOfFluidInputSlots = 34;
        $machine->numberOfFluidOutputSlots = 56;
        $machine->numberOfModuleSlots = 78;
        $machine->energyUsage = 2.1;
        $machine->energyUsageUnit = 'jkl';
        $machine->iconId = 'mno';
        $machine->localisedName = ['pqr', 42];
        $machine->localisedDescription = ['stu', 21];
        $machine->labels->set('vwx', 'yza');
        $machine->descriptions->set('bcd', 'efg');

        return $machine;
    }

    protected function getData(): array
    {
        return [
            'name' => 'abc',
            'craftingCategories' => ['def', 'ghi'],
            'resourceCategories' => ['hij', 'klm'],
            'speed' => 13.37,
            'numberOfItemSlots' => 12,
            'numberOfFluidInputSlots' => 34,
            'numberOfFluidOutputSlots' => 56,
            'numberOfModuleSlots' => 78,
            'energyUsage' => 2.1,
            'energyUsageUnit' => 'jkl',
            'iconId' => 'mno',
            'localisedName' => ['pqr', 42],
            'localisedDescription' => ['stu', 21],
            'labels' => [
                'vwx' => 'yza',
            ],
            'descriptions' => [
                'bcd' => 'efg',
            ],
        ];
    }

    protected function getHashData(): array
    {
        return [
            'name' => 'abc',
            'craftingCategories' => ['def', 'ghi'],
            'resourceCategories' => ['hij', 'klm'],
            'speed' => 13.37,
            'numberOfItemSlots' => 12,
            'numberOfFluidInputSlots' => 34,
            'numberOfFluidOutputSlots' => 56,
            'numberOfModuleSlots' => 78,
            'energyUsage' => 2.1,
            'energyUsageUnit' => 'jkl',
            'localisedName' => ['pqr', 42],
            'localisedDescription' => ['stu', 21],
        ];
    }
}
