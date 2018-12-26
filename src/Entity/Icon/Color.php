<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Icon;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\EntityInterface;
use FactorioItemBrowser\ExportData\Utils\EntityUtils;

/**
 * A class holding information about a color.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Color implements EntityInterface
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
    public function setRed(float $red, float $scale = 1.)
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
    public function setGreen(float $green, float $scale = 1.)
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
    public function setBlue(float $blue, float $scale = 1.)
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
    public function setAlpha(float $alpha, float $scale = 1.)
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

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder->setFloat('r', $this->getRed(), 1.)
                    ->setFloat('g', $this->getGreen(), 1.)
                    ->setFloat('b', $this->getBlue(), 1.)
                    ->setFloat('a', $this->getAlpha(), 1.);
        return $dataBuilder->getData();
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->red = $data->getFloat('r', 1.);
        $this->green = $data->getFloat('g', 1.);
        $this->blue = $data->getFloat('b', 1.);
        $this->alpha = $data->getFloat('a', 1.);
        return $this;
    }

    /**
     * Calculates a hash value representing the entity.
     * @return string
     */
    public function calculateHash(): string
    {
        return EntityUtils::calculateHashOfArray([
            $this->red,
            $this->green,
            $this->blue,
            $this->alpha,
        ]);
    }
}
