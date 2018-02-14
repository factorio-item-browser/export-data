<?php

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Icon\Layer;

/**
 * The class representing an icon of an item or recipe.
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
    protected $iconHash = '';

    /**
     * The layers of the icon.
     * @var array|Layer[]
     */
    protected $layers = [];

    /**
     * Clones the entity.
     */
    public function __clone()
    {
        $this->layers = array_map(function(Layer $layer): Layer {
            return clone($layer);
        }, $this->layers);
    }

    /**
     * Sets the hash of the icon.
     * @param string $iconHash
     * @return $this Implementing fluent interface.
     */
    public function setIconHash(string $iconHash)
    {
        $this->iconHash = $iconHash;
        return $this;
    }

    /**
     * Returns the hash of the icon.
     * @return string
     */
    public function getIconHash(): string
    {
        return $this->iconHash;
    }

    /**
     * Sets the layers of the icon.
     * @param array|Layer[] $layers
     * @return $this Implementing fluent interface.
     */
    public function setLayers(array $layers)
    {
        $this->layers = array_values(array_filter($layers, function ($layer): bool {
            return $layer instanceof Layer;
        }));
        return $this;
    }

    /**
     * Adds a layer to the icon.
     * @param Layer $layer
     * @return $this
     */
    public function addLayer(Layer $layer)
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