<?php

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\LocalisedString;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use FactorioItemBrowser\ExportData\Entity\Recipe\Product;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the recipe class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass FactorioItemBrowser\ExportData\Entity\Recipe
 */
class RecipeTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $recipe = new Recipe();

        $this->assertEquals('', $recipe->getType());
        $this->assertEquals('', $recipe->getName());
        $this->assertEquals([], $recipe->getIngredients());
        $this->assertEquals([], $recipe->getProducts());
        $this->assertEquals(0, $recipe->getCraftingTime());
        $this->assertInstanceOf(LocalisedString::class, $recipe->getLabels());
        $this->assertInstanceOf(LocalisedString::class, $recipe->getDescriptions());
        $this->assertEquals('', $recipe->getIconHash());
    }

    /**
     * Tests the cloning.
     */
    public function testClone()
    {
        $ingredient = new Ingredient();
        $ingredient->setType('ghi');
        $product = new Product();
        $product->setType('jkl');

        $recipe = new Recipe();
        $recipe->setType('foo')
               ->setName('bar')
               ->addIngredient($ingredient)
               ->addProduct($product)
               ->setIconHash('baz');
        $recipe->getLabels()->setTranslation('en', 'abc');
        $recipe->getDescriptions()->setTranslation('en', 'def');

        $clonedRecipe = clone($recipe);
        $recipe->setType('oof')
               ->setName('rab')
               ->setIconHash('zab');
        $recipe->getLabels()->setTranslation('en', 'cba');
        $recipe->getDescriptions()->setTranslation('en', 'fde');
        $ingredient->setType('ihg');
        $product->setType('lkj');

        $this->assertEquals('foo', $clonedRecipe->getType());
        $this->assertEquals('bar', $clonedRecipe->getName());
        $this->assertEquals('baz', $clonedRecipe->getIconHash());
        $this->assertEquals('abc', $clonedRecipe->getLabels()->getTranslation('en'));
        $this->assertEquals('def', $clonedRecipe->getDescriptions()->getTranslation('en'));

        $ingredients = $clonedRecipe->getIngredients();
        $this->assertEquals('ghi', array_pop($ingredients)->getType());
        $products = $clonedRecipe->getProducts();
        $this->assertEquals('jkl', array_pop($products)->getType());
    }

    /**
     * Tests setting and getting the type.
     */
    public function testSetAndGetType()
    {
        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setType('foo'));
        $this->assertEquals('foo', $recipe->getType());
    }

    /**
     * Tests setting and getting the name.
     */
    public function testSetAndGetName()
    {
        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setName('foo'));
        $this->assertEquals('foo', $recipe->getName());
    }

    /**
     * Tests setting, adding and getting the ingredients.
     */
    public function testSetAddAndGetIngredients()
    {
        $ingredient1 = new Ingredient();
        $ingredient1->setType('abc');
        $ingredient2 = new Ingredient();
        $ingredient2->setType('def');
        $ingredient3 = new Ingredient();
        $ingredient3->setType('ghi');

        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setIngredients([$ingredient1, new Product(), $ingredient2]));
        $this->assertEquals([$ingredient1, $ingredient2], $recipe->getIngredients());

        $this->assertEquals($recipe, $recipe->addIngredient($ingredient3));
        $this->assertEquals([$ingredient1, $ingredient2, $ingredient3], $recipe->getIngredients());
    }

    /**
     * Tests setting, adding and getting the products.
     */
    public function testSetAddAndGetProducts()
    {
        $product1 = new Product();
        $product1->setType('abc');
        $product2 = new Product();
        $product2->setType('def');
        $product3 = new Product();
        $product3->setType('ghi');

        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setProducts([$product1, new Ingredient(), $product2]));
        $this->assertEquals([$product1, $product2], $recipe->getProducts());

        $this->assertEquals($recipe, $recipe->addProduct($product3));
        $this->assertEquals([$product1, $product2, $product3], $recipe->getProducts());
    }

    /**
     * Tests setting and getting the crafting time.
     */
    public function testSetAndGetCraftingTime()
    {
        $recipe = new Recipe();
        $this->assertEquals($recipe, $recipe->setCraftingTime(13.37));
        $this->assertEquals(13.37, $recipe->getCraftingTime());
    }

    /**
     * Tests setting and getting the labels.
     */
    public function testSetAndGetLabels()
    {
        $labels = new LocalisedString();
        $labels->setTranslation('en', 'foo');

        $item = new Recipe();
        $this->assertEquals($item, $item->setLabels($labels));
        $this->assertEquals($labels, $item->getLabels());
    }

    /**
     * Tests setting and getting the descriptions.
     */
    public function testSetAndGetDescriptions()
    {
        $descriptions = new LocalisedString();
        $descriptions->setTranslation('en', 'foo');

        $item = new Recipe();
        $this->assertEquals($item, $item->setDescriptions($descriptions));
        $this->assertEquals($descriptions, $item->getDescriptions());
    }

    /**
     * Tests setting and getting the icon hash.
     */
    public function testSetAndGetIconHash()
    {
        $item = new Recipe();
        $this->assertEquals($item, $item->setIconHash('foo'));
        $this->assertEquals('foo', $item->getIconHash());
    }
}
