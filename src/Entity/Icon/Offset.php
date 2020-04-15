<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Icon;

/**
 * The entity representing the offset of a layer.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Offset
{
    /**
     * The X offset.
     * @var int
     */
    protected $x = 0;

    /**
     * The Y offset.
     * @var int
     */
    protected $y = 0;

    /**
     * Sets the X offset.
     * @param int $x
     * @return $this
     */
    public function setX(int $x): self
    {
        $this->x = $x;
        return $this;
    }

    /**
     * Returns the X offset.
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * Sets the Y offset.
     * @param int $y
     * @return $this
     */
    public function setY(int $y): self
    {
        $this->y = $y;
        return $this;
    }

    /**
     * Returns the Y offset.
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }
}
