<?php

namespace FactorioItemBrowser\ExportData\Entity\Icon;

/**
 * The entity representing one layer of an icon.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Layer
{
    /**
     * The file name of the icon layer.
     * @var string
     */
    protected $fileName = '';

    /**
     * The tint color of the layer.
     * @var Color
     */
    protected $tintColor;

    /**
     * The x offset of the layer.
     * @var int
     */
    protected $offsetX = 0;

    /**
     * The y offset of the layer.
     * @var int
     */
    protected $offsetY = 0;

    /**
     * The scale of the layer.
     * @var float
     */
    protected $scale = 1.;

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->tintColor = new Color();
    }

    /**
     * Clones the entity.
     */
    public function __clone()
    {
        $this->tintColor = clone($this->tintColor);
    }

    /**
     * Sets the file name of the icon layer.
     * @param string $fileName
     * @return $this Implementing fluent interface.
     */
    public function setFileName(string $fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * Returns the file name of the icon layer.
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Sets the tint color of the layer.
     * @param Color $tintColor
     * @return $this Implementing fluent interface.
     */
    public function setTintColor(Color $tintColor)
    {
        $this->tintColor = $tintColor;
        return $this;
    }

    /**
     * Returns the tint color of the layer.
     * @return Color
     */
    public function getTintColor(): Color
    {
        return $this->tintColor;
    }

    /**
     * Sets the x offset of the layer.
     * @param int $offsetX
     * @return $this Implementing fluent interface.
     */
    public function setOffsetX(int $offsetX)
    {
        $this->offsetX = $offsetX;
        return $this;
    }

    /**
     * Returns the x offset of the layer.
     * @return int
     */
    public function getOffsetX(): int
    {
        return $this->offsetX;
    }

    /**
     * Sets the y offset of the layer.
     * @param int $offsetY
     * @return $this Implementing fluent interface.
     */
    public function setOffsetY(int $offsetY)
    {
        $this->offsetY = $offsetY;
        return $this;
    }

    /**
     * Returns the y offset of the layer.
     * @return int
     */
    public function getOffsetY(): int
    {
        return $this->offsetY;
    }

    /**
     * Sets the scale of the layer.
     * @param float $scale
     * @return $this Implementing fluent interface.
     */
    public function setScale(float $scale)
    {
        $this->scale = $scale;
        return $this;
    }

    /**
     * Returns the scale of the layer.
     * @return float
     */
    public function getScale(): float
    {
        return $this->scale;
    }
}