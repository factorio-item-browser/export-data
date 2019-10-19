<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

/**
 * The class representing a (crafting) machine from the export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Machine
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
     * The icon id of the machine.
     * @var string
     */
    protected $iconId = '';

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->labels = new LocalisedString();
        $this->descriptions = new LocalisedString();
    }

    /**
     * Sets the name of the machine.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name): self
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
    public function setLabels(LocalisedString $labels): self
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
    public function setDescriptions(LocalisedString $descriptions): self
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
    public function setCraftingCategories(array $craftingCategories): self
    {
        $this->craftingCategories = $craftingCategories;
        return $this;
    }

    /**
     * Adds a crafting category supported by the machine.
     * @param string $craftingCategory
     * @return $this
     */
    public function addCraftingCategory(string $craftingCategory): self
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
    public function setCraftingSpeed(float $craftingSpeed): self
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
    public function setNumberOfItemSlots(int $numberOfItemSlots): self
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
    public function setNumberOfFluidInputSlots(int $numberOfFluidInputSlots): self
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
    public function setNumberOfFluidOutputSlots(int $numberOfFluidOutputSlots): self
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
    public function setNumberOfModuleSlots(int $numberOfModuleSlots): self
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
    public function setEnergyUsage(float $energyUsage): self
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
    public function setEnergyUsageUnit(string $energyUsageUnit): self
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
     * Sets the icon id of the machine.
     * @param string $iconId
     * @return $this
     */
    public function setIconId(string $iconId): self
    {
        $this->iconId = $iconId;
        return $this;
    }

    /**
     * Returns the icon id of the machine.
     * @return string
     */
    public function getIconId(): string
    {
        return $this->iconId;
    }
}
