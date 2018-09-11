<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\EntityInterface;
use FactorioItemBrowser\ExportData\Utils\HashUtils;

/**
 * The class representing an actual mod combination of an export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Combination implements EntityInterface
{
    /**
     * The name of the combination.
     * @var string
     */
    protected $name = '';

    /**
     * The name of the main mod of the combination.
     * @var string
     */
    protected $mainModName = '';

    /**
     * The names of the mods which have been loaded for this combination.
     * @var array|string[]
     */
    protected $loadedModNames = [];

    /**
     * The names of optional mods which have been loaded for this combination.
     * @var array|string[]
     */
    protected $loadedOptionalModNames = [];

    /**
     * The item hashes of the combination.
     * @var array|string[]
     */
    protected $itemHashes = [];

    /**
     * The recipe hashes of the combination.
     * @var array|string[]
     */
    protected $recipeHashes = [];

    /**
     * The machine hashes of the combination.
     * @var array|string[]
     */
    protected $machineHashes = [];

    /**
     * The icon hashes of the combination.
     * @var array|string[]
     */
    protected $iconHashes = [];
    
    /**
     * Sets the name of the combination.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the combination.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name of the main mod of the combination.
     * @param string $mainModName
     * @return $this Implementing fluent interface.
     */
    public function setMainModName(string $mainModName)
    {
        $this->mainModName = $mainModName;
        return $this;
    }

    /**
     * Returns the name of the main mod of the combination.
     * @return string
     */
    public function getMainModName(): string
    {
        return $this->mainModName;
    }

    /**
     * Sets the names of the mods which have been loaded for this combination.
     * @param array|string[] $loadedModNames
     * @return $this Implementing fluent interface.
     */
    public function setLoadedModNames(array $loadedModNames)
    {
        $this->loadedModNames = $loadedModNames;
        return $this;
    }

    /**
     * Adds a name of a mod which have been loaded for this combination.
     * @param string $loadedModName
     * @return $this
     */
    public function addLoadedModName(string $loadedModName)
    {
        $this->loadedModNames[] = $loadedModName;
        return $this;
    }

    /**
     * Returns the names of the mods which have been loaded for this combination.
     * @return array|string[]
     */
    public function getLoadedModNames(): array
    {
        return $this->loadedModNames;
    }

    /**
     * Sets the names of optional mods which have been loaded for this combination.
     * @param array|string[] $loadedOptionalModNames
     * @return $this Implementing fluent interface.
     */
    public function setLoadedOptionalModNames(array $loadedOptionalModNames)
    {
        $this->loadedOptionalModNames = $loadedOptionalModNames;
        return $this;
    }

    /**
     * Adds the name of an optional mod which have been loaded for this combination.
     * @param string $loadedOptionalModName
     * @return $this
     */
    public function addLoadedOptionalModName(string $loadedOptionalModName)
    {
        $this->loadedOptionalModNames[] = $loadedOptionalModName;
        return $this;
    }

    /**
     * Returns the names of optional mods which have been loaded for this combination.
     * @return array|string[]
     */
    public function getLoadedOptionalModNames(): array
    {
        return $this->loadedOptionalModNames;
    }

    /**
     * Sets the item hashes of the combination.
     * @param array|string[] $itemHashes
     * @return $this
     */
    public function setItemHashes(array $itemHashes)
    {
        $this->itemHashes = $itemHashes;
        return $this;
    }

    /**
     * Adds a item hash to the combination.
     * @param string $itemHash
     * @return $this
     */
    public function addItemHash(string $itemHash)
    {
        $this->itemHashes[] = $itemHash;
        return $this;
    }

    /**
     * Returns the item hashes of the combination.
     * @return array|string[]
     */
    public function getItemHashes(): array
    {
        return $this->itemHashes;
    }

    /**
     * Sets the recipe hashes of the combination.
     * @param array|string[] $recipeHashes
     * @return $this
     */
    public function setRecipeHashes(array $recipeHashes)
    {
        $this->recipeHashes = $recipeHashes;
        return $this;
    }

    /**
     * Adds a recipe hash to the combination.
     * @param string $recipeHash
     * @return $this
     */
    public function addRecipeHash(string $recipeHash)
    {
        $this->recipeHashes[] = $recipeHash;
        return $this;
    }

    /**
     * Returns the recipe hashes of the combination.
     * @return array|string[]
     */
    public function getRecipeHashes(): array
    {
        return $this->recipeHashes;
    }

    /**
     * Sets the machine hashes of the combination.
     * @param array|string[] $machineHashes
     * @return $this
     */
    public function setMachineHashes(array $machineHashes)
    {
        $this->machineHashes = $machineHashes;
        return $this;
    }

    /**
     * Adds a machine hash to the combination.
     * @param string $machineHash
     * @return $this
     */
    public function addMachineHash(string $machineHash)
    {
        $this->machineHashes[] = $machineHash;
        return $this;
    }

    /**
     * Returns the machine hashes of the combination.
     * @return array|string[]
     */
    public function getMachineHashes(): array
    {
        return $this->machineHashes;
    }

    /**
     * Sets the icon hashes of the combination.
     * @param array|string[] $iconHashes
     * @return $this
     */
    public function setIconHashes(array $iconHashes)
    {
        $this->iconHashes = $iconHashes;
        return $this;
    }

    /**
     * Adds a icon hash to the combination.
     * @param string $iconHash
     * @return $this
     */
    public function addIconHash(string $iconHash)
    {
        $this->iconHashes[] = $iconHash;
        return $this;
    }

    /**
     * Returns the icon hashes of the combination.
     * @return array|string[]
     */
    public function getIconHashes(): array
    {
        return $this->iconHashes;
    }
    
    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder->setString('n', $this->name, '')
                    ->setString('m', $this->mainModName, '')
                    ->setArray('l', array_unique($this->loadedModNames), 'strval', [])
                    ->setArray('o', array_unique($this->loadedOptionalModNames), 'strval', [])
                    ->setArray('i', array_unique($this->itemHashes), 'strval', [])
                    ->setArray('r', array_unique($this->recipeHashes), 'strval', [])
                    ->setArray('a', array_unique($this->machineHashes), 'strval', [])
                    ->setArray('c', array_unique($this->iconHashes), 'strval', []);
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
        $this->mainModName = $data->getString('m', '');
        $this->loadedModNames = array_map('strval', $data->getArray('l'));
        $this->loadedOptionalModNames = array_map('strval', $data->getArray('o'));
        $this->itemHashes = array_map('strval', $data->getArray('i'));
        $this->recipeHashes = array_map('strval', $data->getArray('r'));
        $this->machineHashes = array_map('strval', $data->getArray('a'));
        $this->iconHashes = array_map('strval', $data->getArray('c'));
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
            $this->mainModName,
            $this->loadedModNames,
            $this->loadedOptionalModNames,
        ]);
    }
}
