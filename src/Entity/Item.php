<?php

declare(strict_types=1);

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
     * The icon id of the item.
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
     * Sets the type of the item.
     * @param string $type
     * @return $this Implementing fluent interface.
     */
    public function setType(string $type): self
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
    public function setName(string $name): self
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
    public function setLabels(LocalisedString $labels): self
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
    public function setDescriptions(LocalisedString $descriptions): self
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
     * Sets the icon id of the item.
     * @param string $iconId
     * @return $this Implementing fluent interface.
     */
    public function setIconId(string $iconId): self
    {
        $this->iconId = $iconId;
        return $this;
    }

    /**
     * Returns the icon id of the item.
     * @return string
     */
    public function getIconId(): string
    {
        return $this->iconId;
    }
}
