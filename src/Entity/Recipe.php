<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use FactorioItemBrowser\ExportData\Entity\Recipe\Product;

/**
 * The class representing a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Recipe
{
    /**
     * The name of the recipe.
     * @var string
     */
    protected $name = '';

    /**
     * The mode of the recipe.
     * @var string
     */
    protected $mode = '';

    /**
     * The ingredients of the recipe.
     * @var array|Ingredient[]
     */
    protected $ingredients = [];

    /**
     * The products of the recipe.
     * @var array|Product[]
     */
    protected $products = [];

    /**
     * The crafting time of the recipe.
     * @var float
     */
    protected $craftingTime = 0.;

    /**
     * The crafting category of the recipe.
     * @var string
     */
    protected $craftingCategory = '';

    /**
     * The localised labels of the recipe.
     * @var LocalisedString
     */
    protected $labels;

    /**
     * The localised descriptions of the recipe.
     * @var LocalisedString
     */
    protected $descriptions;

    /**
     * The icon id of the recipe.
     * @var string
     */
    protected $iconId = '';

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->labels = new LocalisedString();
        $this->descriptions = new LocalisedString();
    }

    /**
     * Sets the name of the recipe.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name of the recipe.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the mode of the recipe.
     * @param string $mode
     * @return $this Implementing fluent interface.
     */
    public function setMode(string $mode): self
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * Returns the mode of the recipe.
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * Sets the ingredients of the recipe.
     * @param array|Ingredient[] $ingredients
     * @return $this Implementing fluent interface.
     */
    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;
        return $this;
    }

    /**
     * Adds an ingredient to the recipe.
     * @param Ingredient $ingredient
     * @return $this
     */
    public function addIngredient(Ingredient $ingredient): self
    {
        $this->ingredients[] = $ingredient;
        return $this;
    }

    /**
     * Returns the ingredients of the recipe.
     * @return array|Ingredient[]
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * Sets the products of the recipe.
     * @param array|Product[] $products
     * @return $this Implementing fluent interface.
     */
    public function setProducts(array $products): self
    {
        $this->products = $products;
        return $this;
    }

    /**
     * Adds a product to the recipe.
     * @param Product $product
     * @return $this
     */
    public function addProduct(Product $product): self
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * Returns the products of the recipe.
     * @return array|Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * Sets the crafting time of the recipe.
     * @param float $craftingTime
     * @return $this Implementing fluent interface.
     */
    public function setCraftingTime(float $craftingTime): self
    {
        $this->craftingTime = $craftingTime;
        return $this;
    }

    /**
     * Returns the crafting time of the recipe.
     * @return float
     */
    public function getCraftingTime(): float
    {
        return $this->craftingTime;
    }

    /**
     * Sets the crafting category of the recipe.
     * @param string $craftingCategory
     * @return $this
     */
    public function setCraftingCategory(string $craftingCategory): self
    {
        $this->craftingCategory = $craftingCategory;
        return $this;
    }

    /**
     * Returns the crafting category of the recipe.
     * @return string
     */
    public function getCraftingCategory(): string
    {
        return $this->craftingCategory;
    }

    /**
     * Sets the localised labels of the recipe.
     * @param LocalisedString $labels
     * @return $this Implementing fluent interface.
     */
    public function setLabels(LocalisedString $labels): self
    {
        $this->labels = $labels;
        return $this;
    }

    /**
     * Returns the localised labels of the recipe.
     * @return LocalisedString
     */
    public function getLabels(): LocalisedString
    {
        return $this->labels;
    }

    /**
     * Sets the localised descriptions of the recipe.
     * @param LocalisedString $descriptions
     * @return $this Implementing fluent interface.
     */
    public function setDescriptions(LocalisedString $descriptions): self
    {
        $this->descriptions = $descriptions;
        return $this;
    }

    /**
     * Returns the localised descriptions of the recipe.
     * @return LocalisedString
     */
    public function getDescriptions(): LocalisedString
    {
        return $this->descriptions;
    }

    /**
     * Sets the icon id of the recipe.
     * @param string $iconId
     * @return $this Implementing fluent interface.
     */
    public function setIconId(string $iconId): self
    {
        $this->iconId = $iconId;
        return $this;
    }

    /**
     * Returns the icon id of the recipe.
     * @return string
     */
    public function getIconId(): string
    {
        return $this->iconId;
    }
}
