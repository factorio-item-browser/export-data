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
     * The hash of the icon.
     * @var string
     */
    protected $hash = '';

    /**
     * The original size of the icon.
     * @var int
     */
    protected $size = 0;

    /**
     * The rendered size of the icon.
     * @var int
     */
    protected $renderedSize = 0;

    /**
     * The layers of the icon.
     * @var array|Layer[]
     */
    protected $layers = [];

    /**
     * Sets the hash of the icon.
     * @param string $hash
     * @return $this
     */
    public function setHash(string $hash): self
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * Returns the hash of the icon.
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * Sets the original size of the icon.
     * @param int $size
     * @return $this
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Returns the original size of the icon.
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Sets the rendered size of the icon.
     * @param int $renderedSize
     * @return $this
     */
    public function setRenderedSize(int $renderedSize): self
    {
        $this->renderedSize = $renderedSize;
        return $this;
    }

    /**
     * Returns the rendered size of the icon.
     * @return int
     */
    public function getRenderedSize(): int
    {
        return $this->renderedSize;
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
