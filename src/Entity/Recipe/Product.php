<?php

namespace FactorioItemBrowser\ExportData\Entity\Recipe;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\EntityInterface;

/**
 * The class representing a product of a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Product implements EntityInterface
{
    /**
     * The type of the product.
     * @var string
     */
    protected $type = '';

    /**
     * The name of the product.
     * @var string
     */
    protected $name = '';

    /**
     * The minimal amount of the product from the recipe.
     * @var float
     */
    protected $amountMin = 1.;

    /**
     * The maximal amount of the product from the recipe.
     * @var float
     */
    protected $amountMax = 1.;

    /**
     * The probability in which the product is returned from the recipe.
     * @var float
     */
    protected $probability = 1.;

    /**
     * The order of the product in the recipe.
     * @var int
     */
    protected $order = 0;

    /**
     * Sets the type of the product.
     * @param string $type
     * @return $this Implementing fluent interface.
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Returns the type of the product.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets the name of the product.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the product.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the minimal amount of the product from the recipe.
     * @param float $amountMin
     * @return $this Implementing fluent interface.
     */
    public function setAmountMin(float $amountMin)
    {
        $this->amountMin = $amountMin;
        return $this;
    }

    /**
     * Returns the minimal amount of the product from the recipe.
     * @return float
     */
    public function getAmountMin(): float
    {
        return $this->amountMin;
    }

    /**
     * Sets the maximal amount of the product from the recipe.
     * @param float $amountMax
     * @return $this Implementing fluent interface.
     */
    public function setAmountMax(float $amountMax)
    {
        $this->amountMax = $amountMax;
        return $this;
    }

    /**
     * Returns the maximal amount of the product from the recipe.
     * @return float
     */
    public function getAmountMax(): float
    {
        return $this->amountMax;
    }

    /**
     * Sets the probability in which the product is returned from the recipe.
     * @param float $probability
     * @return $this Implementing fluent interface.
     */
    public function setProbability(float $probability)
    {
        $this->probability = $probability;
        return $this;
    }

    /**
     * Returns the probability in which the product is returned from the recipe.
     * @return float
     */
    public function getProbability(): float
    {
        return $this->probability;
    }

    /**
     * Sets the order of the product in the recipe.
     * @param int $order
     * @return $this Implementing fluent interface.
     */
    public function setOrder(int $order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Returns the order of the product in the recipe.
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder->setString('t', $this->type, '')
                    ->setString('n', $this->name, '')
                    ->setFloat('i', $this->amountMin, 1.)
                    ->setFloat('a', $this->amountMax, 1.)
                    ->setFloat('p', $this->probability, 1.)
                    ->setInteger('o', $this->order, 0);
        return $dataBuilder->getData();
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->type = $data->getString('t', '');
        $this->name = $data->getString('n', '');
        $this->amountMin = $data->getFloat('i', 1.);
        $this->amountMax = $data->getFloat('a', 1.);
        $this->probability = $data->getFloat('p', 1.);
        $this->order = $data->getInteger('o', 0);
        return $this;
    }
}
