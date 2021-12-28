<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use JMS\Serializer\Annotation\Type;

/**
 * The class representing a (crafting) machine from the export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Machine extends LocalisedEntity
{
    /**
     * The name of the machine.
     */
    public string $name = '';

    /**
     * The crafting categories supported by the machine to craft.
     * @var array<string>
     */
    #[Type('array<string>')]
    public array $craftingCategories = [];

    /**
     * The resource categories supported by the machine to mine.
     * @var array<string>
     */
    #[Type('array<string>')]
    public array $resourceCategories = [];

    /**
     * The speed of the machine, either the crafting speed, or the mining speed in case of mining drills.
     */
    public float $speed = 1.;

    /**
     * The number of items supported by the machine.
     */
    public int $numberOfItemSlots = 0;

    /**
     * The number of input fluids supported by the machine.
     */
    public int $numberOfFluidInputSlots = 0;

    /**
     * The number of output fluids supported by the machine.
     */
    public int $numberOfFluidOutputSlots = 0;

    /**
     * The number of modules supported by the machine.
     */
    public int $numberOfModuleSlots = 0;

    /**
     * The energy usage of the machine.
     */
    public float $energyUsage = 0.;

    /**
     * The unit for the energy usage.
     */
    public string $energyUsageUnit = 'W';

    /**
     * The ID of the icon used for the machine.
     */
    public string $iconId = '';
}
