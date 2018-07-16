<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;

/**
 * The class representing an item from the export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Item implements EntityInterface
{
    /**
     * The type of the item.
     * @var string
     */
    protected $type = '';

    /**
     * The name of the item.
     * @var string
     */
    protected $name = '';

    /**
     * The localised labels of the item.
     * @var LocalisedString
     */
    protected $labels;

    /**
     * The localised descriptions of the item.
     * @var LocalisedString
     */
    protected $descriptions;

    /**
     * Whether the item is providing the localisation of a recipe with the same name.
     * @var bool
     */
    protected $providesRecipeLocalisation = false;

    /**
     * Whether the item is providing the localisation of a machine with the same name.
     * @var bool
     */
    protected $providesMachineLocalisation = false;

    /**
     * The icon hash of the item.
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
     * Sets the type of the item.
     * @param string $type
     * @return $this Implementing fluent interface.
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Returns the type of the item.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets the name of the item.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the item.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the localised labels of the item.
     * @param LocalisedString $labels
     * @return $this Implementing fluent interface.
     */
    public function setLabels(LocalisedString $labels)
    {
        $this->labels = $labels;
        return $this;
    }

    /**
     * Returns the localised labels of the item.
     * @return LocalisedString
     */
    public function getLabels(): LocalisedString
    {
        return $this->labels;
    }

    /**
     * Sets the localised descriptions of the item.
     * @param LocalisedString $descriptions
     * @return $this Implementing fluent interface.
     */
    public function setDescriptions(LocalisedString $descriptions)
    {
        $this->descriptions = $descriptions;
        return $this;
    }

    /**
     * Returns the localised descriptions of the item.
     * @return LocalisedString
     */
    public function getDescriptions(): LocalisedString
    {
        return $this->descriptions;
    }

    /**
     * Sets whether the item is providing the localisation of a recipe with the same name.
     * @param bool $providesRecipeLocalisation
     * @return $this Implementing fluent interface.
     */
    public function setProvidesRecipeLocalisation(bool $providesRecipeLocalisation)
    {
        $this->providesRecipeLocalisation = $providesRecipeLocalisation;
        return $this;
    }

    /**
     * Returns whether the item is providing the localisation of a recipe with the same name.
     * @return bool
     */
    public function getProvidesRecipeLocalisation(): bool
    {
        return $this->providesRecipeLocalisation;
    }

    /**
     * Sets whether the item is providing the localisation of a machine with the same name.
     * @param bool $providesMachineLocalisation
     * @return $this Implementing fluent interface.
     */
    public function setProvidesMachineLocalisation(bool $providesMachineLocalisation)
    {
        $this->providesMachineLocalisation = $providesMachineLocalisation;
        return $this;
    }

    /**
     * Returns whether the item is providing the localisation of a machine with the same name.
     * @return bool
     */
    public function getProvidesMachineLocalisation(): bool
    {
        return $this->providesMachineLocalisation;
    }

    /**
     * Sets the icon hash of the item.
     * @param string $iconHash
     * @return $this Implementing fluent interface.
     */
    public function setIconHash(string $iconHash)
    {
        $this->iconHash = $iconHash;
        return $this;
    }

    /**
     * Returns the icon hash of the item.
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
        $dataBuilder->setString('t', $this->getType(), '')
                    ->setString('n', $this->getName(), '')
                    ->setArray('l', $this->labels->writeData(), null, [])
                    ->setArray('d', $this->descriptions->writeData(), null, [])
                    ->setInteger('r', $this->getProvidesRecipeLocalisation() ? 1 : 0, 0)
                    ->setInteger('m', $this->getProvidesMachineLocalisation() ? 1 : 0, 0)
                    ->setString('i', $this->iconHash, '');
        return $dataBuilder->getData();
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->type = $data->getString('t', '');
        $this->name = $data->getString('n', '');
        $this->labels->readData($data->getObject('l'));
        $this->descriptions->readData($data->getObject('d'));
        $this->providesRecipeLocalisation = $data->getInteger('r', 0) === 1;
        $this->providesMachineLocalisation = $data->getInteger('m', 0) === 1;
        $this->iconHash = $data->getString('i');
        return $this;
    }
}
