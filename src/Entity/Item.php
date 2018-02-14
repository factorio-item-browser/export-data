<?php

namespace FactorioItemBrowser\ExportData\Entity;

/**
 * The class representing an item from the export.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Item
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
}