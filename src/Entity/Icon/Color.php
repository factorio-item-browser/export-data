<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Icon;

/**
 * The entity representing an icon color.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Color
{
    /**
     * The red component of the color.
     * @var float
     */
    protected $red = 1.;

    /**
     * The green component of the color.
     * @var float
     */
    protected $green = 1.;

    /**
     * The blue component of the color.
     * @var float
     */
    protected $blue = 1.;

    /**
     * The alpha component of the color.
     * @var float
     */
    protected $alpha = 1.;

    /**
     * Sets the red component of the color.
     * @param float $red
     * @param float $scale
     * @return $this
     */
    public function setRed(float $red, float $scale = 1.): self
    {
        $this->red = $this->setComponent($red, $scale);
        return $this;
    }

    /**
     * Returns the red component of the color.
     * @param float $scale
     * @return float
     */
    public function getRed(float $scale = 1.): float
    {
        return $this->getComponent($this->red, $scale);
    }

    /**
     * Sets the green component of the color.
     * @param float $green
     * @param float $scale
     * @return $this
     */
    public function setGreen(float $green, float $scale = 1.): self
    {
        $this->green = $this->setComponent($green, $scale);
        return $this;
    }

    /**
     * Returns the green component of the color.
     * @param float $scale
     * @return float
     */
    public function getGreen(float $scale = 1.): float
    {
        return $this->getComponent($this->green, $scale);
    }

    /**
     * Sets the blue component of the color.
     * @param float $blue
     * @param float $scale
     * @return $this
     */
    public function setBlue(float $blue, float $scale = 1.): self
    {
        $this->blue = $this->setComponent($blue, $scale);
        return $this;
    }

    /**
     * Returns the blue component of the color.
     * @param float $scale
     * @return float
     */
    public function getBlue(float $scale = 1.): float
    {
        return $this->getComponent($this->blue, $scale);
    }

    /**
     * Sets the alpha component of the color.
     * @param float $alpha
     * @param float $scale
     * @return $this
     */
    public function setAlpha(float $alpha, float $scale = 1.): self
    {
        $this->alpha = $this->setComponent($alpha, $scale);
        return $this;
    }

    /**
     * Returns the alpha component of the color.
     * @param float $scale
     * @return float
     */
    public function getAlpha(float $scale = 1.): float
    {
        return $this->getComponent($this->alpha, $scale);
    }

    /**
     * Calculates the value to set a component.
     * @param float $value
     * @param float $scale
     * @return float
     */
    protected function setComponent(float $value, float $scale): float
    {
        return ($scale < 0) ? (1 - $value / -$scale) : ($value / $scale);
    }

    /**
     * Calculates the value to get a component.
     * @param float $value
     * @param float $scale
     * @return float
     */
    protected function getComponent(float $value, float $scale): float
    {
        return ($scale < 0) ? ((1 - $value) * -$scale) : ($value * $scale);
    }
}
