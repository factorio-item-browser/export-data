<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Utils\HashUtils;

/**
 * The class representing a (crafting) machine from the export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Machine implements EntityInterface
{
    /**
     * The name of the machine.
     * @var string
     */
    protected $name = '';

    /**
     * The localised labels of the machine.
     * @var LocalisedString
     */
    protected $labels;

    /**
     * The localised descriptions of the machine.
     * @var LocalisedString
     */
    protected $descriptions;

    /**
     * The crafting categories supported by the machine.
     * @var array|string[]
     */
    protected $craftingCategories = [];

    /**
     * The crafting speed of the machine.
     * @var float
     */
    protected $craftingSpeed = 1.;

    /**
     * The number of item slots available in the machine.
     * @var int
     */
    protected $numberOfItemSlots = 0;

    /**
     * The number of fluid input slots available in the machine.
     * @var int
     */
    protected $numberOfFluidInputSlots = 0;

    /**
     * The number of fluid output slots available in the machine.
     * @var int
     */
    protected $numberOfFluidOutputSlots = 0;

    /**
     * The number of module slots available in the machine.
     * @var int
     */
    protected $numberOfModuleSlots = 0;

    /**
     * The energy usage of the machine.
     * @var float
     */
    protected $energyUsage = 0.;

    /**
     * The unit used for the energy usage.
     * @var string
     */
    protected $energyUsageUnit = 'W';

    /**
     * The icon hash of the machine.
     * @var string
     */
    protected $iconHash = '';

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->labels = new LocalisedString();
        $this->descriptions = new LocalisedString();
    }

    /**
     * Clones the entity.
     */
    public function __clone()
    {
        $this->labels = clone($this->labels);
        $this->descriptions = clone($this->descriptions);
    }

    /**
     * Sets the name of the machine.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the machine.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the localised labels of the machine.
     * @param LocalisedString $labels
     * @return $this Implementing fluent interface.
     */
    public function setLabels(LocalisedString $labels)
    {
        $this->labels = $labels;
        return $this;
    }

    /**
     * Returns the localised labels of the machine.
     * @return LocalisedString
     */
    public function getLabels(): LocalisedString
    {
        return $this->labels;
    }

    /**
     * Sets the localised descriptions of the machine.
     * @param LocalisedString $descriptions
     * @return $this Implementing fluent interface.
     */
    public function setDescriptions(LocalisedString $descriptions)
    {
        $this->descriptions = $descriptions;
        return $this;
    }

    /**
     * Returns the localised descriptions of the machine.
     * @return LocalisedString
     */
    public function getDescriptions(): LocalisedString
    {
        return $this->descriptions;
    }

    /**
     * Sets the crafting categories supported by the machine.
     * @param array|string[] $craftingCategories
     * @return $this
     */
    public function setCraftingCategories(array $craftingCategories)
    {
        $this->craftingCategories = $craftingCategories;
        return $this;
    }

    /**
     * Adds a crafting category supported by the machine.
     * @param string $craftingCategory
     * @return $this
     */
    public function addCraftingCategory(string $craftingCategory)
    {
        $this->craftingCategories[] = $craftingCategory;
        return $this;
    }

    /**
     * Returns the crafting categories supported by the machine.
     * @return array|string[]
     */
    public function getCraftingCategories(): array
    {
        return $this->craftingCategories;
    }

    /**
     * Sets the crafting speed of the machine.
     * @param float $craftingSpeed
     * @return $this
     */
    public function setCraftingSpeed(float $craftingSpeed)
    {
        $this->craftingSpeed = $craftingSpeed;
        return $this;
    }

    /**
     * Returns the crafting speed of the machine.
     * @return float
     */
    public function getCraftingSpeed(): float
    {
        return $this->craftingSpeed;
    }

    /**
     * Sets the number of item slots available in the machine.
     * @param int $numberOfItemSlots
     * @return $this
     */
    public function setNumberOfItemSlots(int $numberOfItemSlots)
    {
        $this->numberOfItemSlots = $numberOfItemSlots;
        return $this;
    }

    /**
     * Returns the number of item slots available in the machine.
     * @return int
     */
    public function getNumberOfItemSlots(): int
    {
        return $this->numberOfItemSlots;
    }

    /**
     * Sets the number of fluid input slots available in the machine.
     * @param int $numberOfFluidInputSlots
     * @return $this
     */
    public function setNumberOfFluidInputSlots(int $numberOfFluidInputSlots)
    {
        $this->numberOfFluidInputSlots = $numberOfFluidInputSlots;
        return $this;
    }

    /**
     * Returns the number of fluid input slots available in the machine.
     * @return int
     */
    public function getNumberOfFluidInputSlots(): int
    {
        return $this->numberOfFluidInputSlots;
    }

    /**
     * Sets the number of fluid output slots available in the machine.
     * @param int $numberOfFluidOutputSlots
     * @return $this
     */
    public function setNumberOfFluidOutputSlots(int $numberOfFluidOutputSlots)
    {
        $this->numberOfFluidOutputSlots = $numberOfFluidOutputSlots;
        return $this;
    }

    /**
     * Returns the number of fluid output slots available in the machine.
     * @return int
     */
    public function getNumberOfFluidOutputSlots(): int
    {
        return $this->numberOfFluidOutputSlots;
    }

    /**
     * Sets the number of module slots available in the machine.
     * @param int $numberOfModuleSlots
     * @return $this
     */
    public function setNumberOfModuleSlots(int $numberOfModuleSlots)
    {
        $this->numberOfModuleSlots = $numberOfModuleSlots;
        return $this;
    }

    /**
     * Returns the number of module slots available in the machine.
     * @return int
     */
    public function getNumberOfModuleSlots(): int
    {
        return $this->numberOfModuleSlots;
    }

    /**
     * Sets the energy usage of the machine.
     * @param float $energyUsage
     * @return $this
     */
    public function setEnergyUsage(float $energyUsage)
    {
        $this->energyUsage = $energyUsage;
        return $this;
    }

    /**
     * Returns the energy usage of the machine.
     * @return float
     */
    public function getEnergyUsage(): float
    {
        return $this->energyUsage;
    }

    /**
     * Sets the unit used for the energy usage.
     * @param string $energyUsageUnit
     * @return $this
     */
    public function setEnergyUsageUnit(string $energyUsageUnit)
    {
        $this->energyUsageUnit = $energyUsageUnit;
        return $this;
    }

    /**
     * Returns the unit used for the energy usage.
     * @return string
     */
    public function getEnergyUsageUnit(): string
    {
        return $this->energyUsageUnit;
    }

    /**
     * Sets the icon hash of the machine.
     * @param string $iconHash
     * @return $this
     */
    public function setIconHash(string $iconHash)
    {
        $this->iconHash = $iconHash;
        return $this;
    }

    /**
     * Returns the icon hash of the machine.
     * @return string
     */
    public function getIconHash(): string
    {
        return $this->iconHash;
    }

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder->setString('n', $this->name, '')
                    ->setArray('l', $this->labels->writeData(), null, [])
                    ->setArray('d', $this->descriptions->writeData(), null, [])
                    ->setArray('c', array_unique($this->craftingCategories), 'strval', [])
                    ->setFloat('s', $this->craftingSpeed, 1.)
                    ->setInteger('i', $this->numberOfItemSlots, 0)
                    ->setInteger('f', $this->numberOfFluidInputSlots, 0)
                    ->setInteger('u', $this->numberOfFluidOutputSlots, 0)
                    ->setInteger('m', $this->numberOfModuleSlots, 0)
                    ->setFloat('e', $this->energyUsage, 0.)
                    ->setString('r', $this->energyUsageUnit, 'W')
                    ->setString('o', $this->iconHash, '');
        return $dataBuilder->getData();
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->name = $data->getString('n', '');
        $this->labels->readData($data->getObject('l'));
        $this->descriptions->readData($data->getObject('d'));
        $this->craftingCategories = array_map('strval', $data->getArray('c'));
        $this->craftingSpeed = $data->getFloat('s', 1.);
        $this->numberOfItemSlots = $data->getInteger('i', 0);
        $this->numberOfFluidInputSlots = $data->getInteger('f', 0);
        $this->numberOfFluidOutputSlots = $data->getInteger('u', 0);
        $this->numberOfModuleSlots = $data->getInteger('m', 0);
        $this->energyUsage = $data->getFloat('e', 0.);
        $this->energyUsageUnit = $data->getString('r', 'W');
        $this->iconHash = $data->getString('o');
        return $this;
    }

    /**
     * Calculates a hash value representing the entity.
     * @return string
     */
    public function calculateHash(): string
    {
        return HashUtils::calculateHashOfArray([
            $this->name,
            $this->labels->calculateHash(),
            $this->descriptions->calculateHash(),
            $this->craftingCategories,
            $this->craftingSpeed,
            $this->numberOfItemSlots,
            $this->numberOfFluidInputSlots,
            $this->numberOfFluidOutputSlots,
            $this->numberOfModuleSlots,
            $this->energyUsage,
            $this->energyUsageUnit,
            $this->iconHash,
        ]);
    }
}
