<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Icon\Layer;

/**
 * The entity representing an icon of an item or recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Icon
{
    /**
     * The id of the icon.
     * @var string
     */
    protected $id = '';

    /**
     * The size of the icon.
     * @var int
     */
    protected $size = 0;

    /**
     * The layers of the icon.
     * @var array|Layer[]
     */
    protected $layers = [];

    /**
     * Sets the id of the icon.
     * @param string $id
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Returns the id of the icon.
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets the size of the icon.
     * @param int $size
     * @return $this
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Returns the size of the icon.
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Sets the layers of the icon.
     * @param array|Layer[] $layers
     * @return $this
     */
    public function setLayers(array $layers): self
    {
        $this->layers = $layers;
        return $this;
    }

    /**
     * Adds a layer to the icon.
     * @param Layer $layer
     * @return $this
     */
    public function addLayer(Layer $layer): self
    {
        $this->layers[] = $layer;
        return $this;
    }

    /**
     * Returns the layers of the icon.
     * @return array|Layer[]
     */
    public function getLayers(): array
    {
        return $this->layers;
    }
}
