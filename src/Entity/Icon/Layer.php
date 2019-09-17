<?php

declare(strict_types=1);

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
     * The tint of the layer.
     * @var Color
     */
    protected $tint;

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
        $this->tint = new Color();
    }

    /**
     * Sets the file name of the icon layer.
     * @param string $fileName
     * @return $this
     */
    public function setFileName(string $fileName): self
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
     * Sets the tint of the layer.
     * @param Color $tint
     * @return $this
     */
    public function setTint(Color $tint): self
    {
        $this->tint = $tint;
        return $this;
    }

    /**
     * Returns the tint of the layer.
     * @return Color
     */
    public function getTint(): Color
    {
        return $this->tint;
    }

    /**
     * Sets the x offset of the layer.
     * @param int $offsetX
     * @return $this
     */
    public function setOffsetX(int $offsetX): self
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
     * @return $this
     */
    public function setOffsetY(int $offsetY): self
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
     * @return $this
     */
    public function setScale(float $scale): self
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
