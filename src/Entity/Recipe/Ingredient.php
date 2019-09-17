<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity\Recipe;

/**
 * The entity representing an ingredient of a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Ingredient
{
    /**
     * The type of the ingredient.
     * @var string
     */
    protected $type = '';

    /**
     * The name of the ingredient.
     * @var string
     */
    protected $name = '';

    /**
     * The amount of the ingredient required for the recipe.
     * @var float
     */
    protected $amount = 1.;

    /**
     * Sets the type of the ingredient.
     * @param string $type
     * @return $this Implementing fluent interface.
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Returns the type of the ingredient.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets the name of the ingredient.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the ingredient.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the amount of the ingredient required for the recipe.
     * @param float $amount
     * @return $this Implementing fluent interface.
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Returns the amount of the ingredient required for the recipe.
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}
