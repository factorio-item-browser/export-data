<?php

namespace FactorioItemBrowser\ExportData\Entity\Recipe;

/**
 * The class representing a product of a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Product
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
    protected $amountMin = 0.;

    /**
     * The maximal amount of the product from the recipe.
     * @var float
     */
    protected $amountMax = 0.;

    /**
     * The probability in which the product is returned from the recipe.
     * @var float
     */
    protected $probability = 0.;

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
}