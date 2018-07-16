<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\EntityInterface;

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
     * The data of the combination.
     * @var CombinationData
     */
    protected $data;

    /**
     * Whether the data of the combination has been loaded.
     * @var bool
     */
    protected $isDataLoaded = false;

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->data = new CombinationData();
    }

    /**
     * Clones the entity.
     */
    public function __clone()
    {
        $this->data = clone($this->data);
    }

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
     * Sets the data of the combination.
     * @param CombinationData $data
     * @return $this
     */
    public function setData(CombinationData $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Returns the data of the combination.
     * @return CombinationData
     */
    public function getData(): CombinationData
    {
        return $this->data;
    }

    /**
     * Sets whether the data of the combination has been loaded.
     * @param bool $isDataLoaded
     * @return $this
     */
    public function setIsDataLoaded(bool $isDataLoaded)
    {
        $this->isDataLoaded = $isDataLoaded;
        return $this;
    }

    /**
     * Returns whether the data of the combination has been loaded.
     * @return bool
     */
    public function getIsDataLoaded(): bool
    {
        return $this->isDataLoaded;
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
                    ->setArray('l', $this->loadedModNames, 'strval', [])
                    ->setArray('o', $this->loadedOptionalModNames, 'strval', []);
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
        return $this;
    }
}
