<?php

namespace FactorioItemBrowser\ExportData\Entity;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;

/**
 * The class representing an icon of an item or recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Icon implements EntityInterface
{
    /**
     * The default size of the icons.
     */
    public const DEFAULT_SIZE = 32;

    /**
     * The hash of the icon.
     * @var string
     */
    protected $hash = '';

    /**
     * The original size of the icon.
     * @var int
     */
    protected $size = self::DEFAULT_SIZE;

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
        $this->layers = array_map(function (Layer $layer): Layer {
            return clone($layer);
        }, $this->layers);
    }

    /**
     * Sets the hash of the icon.
     * @param string $hash
     * @return $this Implementing fluent interface.
     */
    public function setHash(string $hash)
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
    public function setSize(int $size)
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

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder->setString('h', $this->getHash(), '')
                    ->setArray('l', $this->getLayers(), function (Layer $layer): array {
                        return $layer->writeData();
                    }, []);
        return $dataBuilder->getData();
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->hash = $data->getString('h', '');
        $this->layers = array_map(function (DataContainer $data): Layer {
            return (new Layer())->readData($data);
        }, $data->getObjectArray('l'));
        return $this;
    }
}
