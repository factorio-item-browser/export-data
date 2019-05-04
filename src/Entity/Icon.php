<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Icon\Layer;
use FactorioItemBrowser\ExportData\Utils\EntityUtils;

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
    public const DEFAULT_SIZE = 64;

    /**
     * The original size of the icon.
     * @var int
     */
    protected $size = self::DEFAULT_SIZE;

    /**
     * The rendered size of the icon.
     * @var int
     */
    protected $renderedSize = self::DEFAULT_SIZE;

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
     * Sets the rendered size of the icon.
     * @param int $renderedSize
     * @return $this
     */
    public function setRenderedSize(int $renderedSize)
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
        $dataBuilder->setInteger('s', $this->size, self::DEFAULT_SIZE)
                    ->setInteger('r', $this->renderedSize, self::DEFAULT_SIZE)
                    ->setArray('l', $this->layers, function (Layer $layer): array {
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
        $this->size = $data->getInteger('s', self::DEFAULT_SIZE);
        $this->renderedSize = $data->getInteger('r', self::DEFAULT_SIZE);
        $this->layers = array_map(function (DataContainer $data): Layer {
            return (new Layer())->readData($data);
        }, $data->getObjectArray('l'));
        return $this;
    }

    /**
     * Calculates a hash value representing the entity.
     * @return string
     */
    public function calculateHash(): string
    {
        return EntityUtils::calculateHashOfArray([
            $this->size,
            $this->renderedSize,
            array_map(function (Layer $layer): string {
                return $layer->calculateHash();
            }, $this->layers)
        ]);
    }
}
