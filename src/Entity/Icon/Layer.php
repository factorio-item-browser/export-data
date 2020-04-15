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
     * The offset of the layer.
     * @var Offset
     */
    protected $offset;

    /**
     * The scale of the layer.
     * @var float
     */
    protected $scale = 1.;

    /**
     * The size of the layer.
     * @var int
     */
    protected $size = 0;

    /**
     * The tint of the layer.
     * @var Color
     */
    protected $tint;

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->tint = new Color();
        $this->offset = new Offset();
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
     * Sets the offset of the layer.
     * @param Offset $offset
     * @return $this
     */
    public function setOffset(Offset $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Returns the offset of the layer.
     * @return Offset
     */
    public function getOffset(): Offset
    {
        return $this->offset;
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

    /**
     * Sets the size of the layer.
     * @param int $size
     * @return $this
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Returns the size of the layer.
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
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
}
