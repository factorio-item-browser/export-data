<?php

namespace FactorioItemBrowser\ExportData\Entity;

use BluePsyduck\Common\Data\DataBuilder;
use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use FactorioItemBrowser\ExportData\Entity\Recipe\Product;

/**
 * The class representing a recipe.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Recipe implements EntityInterface
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
     * The icon hash of the recipe.
     * @var string
     */
    protected $iconHash = '';

    /**
     * Initializes the entity.
     */
    public function __construct()
    {
        $this->labels = new LocalisedString();
        $this->descriptions = new LocalisedString();
    }

    /**
     * Clones the entity.
     */
    public function __clone()
    {
        $this->ingredients = array_map(function (Ingredient $ingredient): Ingredient {
            return clone($ingredient);
        }, $this->ingredients);
        $this->products = array_map(function (Product $product): Product {
            return clone($product);
        }, $this->products);

        $this->labels = clone($this->labels);
        $this->descriptions = clone($this->descriptions);
    }

    /**
     * Sets the name of the recipe.
     * @param string $name
     * @return $this Implementing fluent interface.
     */
    public function setName(string $name)
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
    public function setMode(string $mode)
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
    public function setIngredients(array $ingredients)
    {
        $this->ingredients = array_values(array_filter($ingredients, function ($ingredient): bool {
            return $ingredient instanceof Ingredient;
        }));
        return $this;
    }

    /**
     * Adds an ingredient to the recipe.
     * @param Ingredient $ingredient
     * @return $this
     */
    public function addIngredient(Ingredient $ingredient)
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
    public function setProducts(array $products)
    {
        $this->products = array_values(array_filter($products, function ($product): bool {
            return $product instanceof Product;
        }));
        return $this;
    }

    /**
     * Adds a product to the recipe.
     * @param Product $product
     * @return $this
     */
    public function addProduct(Product $product)
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
    public function setCraftingTime(float $craftingTime)
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
    public function setCraftingCategory(string $craftingCategory)
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
    public function setLabels(LocalisedString $labels)
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
    public function setDescriptions(LocalisedString $descriptions)
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
     * Sets the icon hash of the recipe.
     * @param string $iconHash
     * @return $this Implementing fluent interface.
     */
    public function setIconHash(string $iconHash)
    {
        $this->iconHash = $iconHash;
        return $this;
    }

    /**
     * Returns the icon hash of the recipe.
     * @return string
     */
    public function getIconHash(): string
    {
        return $this->iconHash;
    }

    /**
     * Writes the entity data to an array.
     * @return array
     */
    public function writeData(): array
    {
        $dataBuilder = new DataBuilder();
        $dataBuilder->setString('n', $this->name, '')
                    ->setString('m', $this->mode, '')
                    ->setArray('i', $this->ingredients, function (Ingredient $ingredient): array {
                        return $ingredient->writeData();
                    }, [])
                    ->setArray('p', $this->products, function (Product $product): array {
                        return $product->writeData();
                    }, [])
                    ->setFloat('c', $this->craftingTime, 0.)
                    ->setString('a', $this->craftingCategory, '')
                    ->setArray('l', $this->labels->writeData(), null, [])
                    ->setArray('d', $this->descriptions->writeData(), null, [])
                    ->setString('h', $this->iconHash, '');
        return $dataBuilder->getData();
    }

    /**
     * Reads the entity data.
     * @param DataContainer $data
     * @return $this
     */
    public function readData(DataContainer $data)
    {
        $this->name = $data->getString('n', '');
        $this->mode = $data->getString('m', '');
        $this->ingredients = array_map(function (DataContainer $data): Ingredient {
            return (new Ingredient())->readData($data);
        }, $data->getObjectArray('i'));
        $this->products = array_map(function (DataContainer $data): Product {
            return (new Product())->readData($data);
        }, $data->getObjectArray('p'));
        $this->craftingTime = $data->getFloat('c', 0.);
        $this->craftingCategory = $data->getString('a', '');
        $this->labels->readData($data->getObject('l'));
        $this->descriptions->readData($data->getObject('d'));
        $this->iconHash = $data->getString('h', '');
        return $this;
    }
}