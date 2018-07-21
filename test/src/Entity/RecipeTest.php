<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use BluePsyduck\Common\Data\DataContainer;
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
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Recipe
 */
class RecipeTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $recipe = new Recipe();

        $this->assertSame('', $recipe->getName());
        $this->assertSame('', $recipe->getMode());
        $this->assertSame([], $recipe->getIngredients());
        $this->assertSame([], $recipe->getProducts());
        $this->assertSame(0., $recipe->getCraftingTime());
        $this->assertSame('', $recipe->getCraftingCategory());
        $this->assertInstanceOf(LocalisedString::class, $recipe->getLabels());
        $this->assertInstanceOf(LocalisedString::class, $recipe->getDescriptions());
        $this->assertSame('', $recipe->getIconHash());
    }

    /**
     * Tests the cloning.
     * @covers ::__clone
     */
    public function testClone()
    {
        $ingredient = new Ingredient();
        $ingredient->setType('ghi');
        $product = new Product();
        $product->setType('jkl');

        $recipe = new Recipe();
        $recipe->setName('foo')
               ->setMode('bar')
               ->addIngredient($ingredient)
               ->addProduct($product)
               ->setCraftingTime(13.37)
               ->setCraftingCategory('mno')
               ->setIconHash('baz');
        $recipe->getLabels()->setTranslation('en', 'abc');
        $recipe->getDescriptions()->setTranslation('en', 'def');

        $clonedRecipe = clone($recipe);
        $recipe->setName('oof')
               ->setMode('rab')
               ->setCraftingTime(73.31)
               ->setCraftingCategory('onm')
               ->setIconHash('zab');
        $recipe->getLabels()->setTranslation('en', 'cba');
        $recipe->getDescriptions()->setTranslation('en', 'fde');
        $ingredient->setType('ihg');
        $product->setType('lkj');

        $this->assertSame('foo', $clonedRecipe->getName());
        $this->assertSame('bar', $clonedRecipe->getMode());
        $this->assertSame(13.37, $clonedRecipe->getCraftingTime());
        $this->assertSame('mno', $clonedRecipe->getCraftingCategory());
        $this->assertSame('baz', $clonedRecipe->getIconHash());
        $this->assertSame('abc', $clonedRecipe->getLabels()->getTranslation('en'));
        $this->assertSame('def', $clonedRecipe->getDescriptions()->getTranslation('en'));

        $ingredients = $clonedRecipe->getIngredients();
        $this->assertSame('ghi', array_pop($ingredients)->getType());
        $products = $clonedRecipe->getProducts();
        $this->assertSame('jkl', array_pop($products)->getType());
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName()
    {
        $recipe = new Recipe();
        $this->assertSame($recipe, $recipe->setName('foo'));
        $this->assertSame('foo', $recipe->getName());
    }

    /**
     * Tests setting and getting the mode.
     * @covers ::setMode
     * @covers ::getMode
     */
    public function testSetAndGetMode()
    {
        $recipe = new Recipe();
        $this->assertSame($recipe, $recipe->setMode('foo'));
        $this->assertSame('foo', $recipe->getMode());
    }

    /**
     * Tests setting, adding and getting the ingredients.
     * @covers ::setIngredients
     * @covers ::getIngredients
     * @covers ::addIngredient
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
        $this->assertSame($recipe, $recipe->setIngredients([$ingredient1, new Product(), $ingredient2]));
        $this->assertSame([$ingredient1, $ingredient2], $recipe->getIngredients());

        $this->assertSame($recipe, $recipe->addIngredient($ingredient3));
        $this->assertSame([$ingredient1, $ingredient2, $ingredient3], $recipe->getIngredients());
    }

    /**
     * Tests setting, adding and getting the products.
     * @covers ::setProducts
     * @covers ::getProducts
     * @covers ::addProduct
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
        $this->assertSame($recipe, $recipe->setProducts([$product1, new Ingredient(), $product2]));
        $this->assertSame([$product1, $product2], $recipe->getProducts());

        $this->assertSame($recipe, $recipe->addProduct($product3));
        $this->assertSame([$product1, $product2, $product3], $recipe->getProducts());
    }

    /**
     * Tests setting and getting the crafting time.
     * @covers ::setCraftingTime
     * @covers ::getCraftingTime
     */
    public function testSetAndGetCraftingTime()
    {
        $recipe = new Recipe();
        $this->assertSame($recipe, $recipe->setCraftingTime(13.37));
        $this->assertSame(13.37, $recipe->getCraftingTime());
    }

    /**
     * Tests setting and getting the craftingCategory.
     * @covers ::setCraftingCategory
     * @covers ::getCraftingCategory
     */
    public function testSetAndGetCraftingCategory()
    {
        $recipe = new Recipe();
        $this->assertSame($recipe, $recipe->setCraftingCategory('abc'));
        $this->assertSame('abc', $recipe->getCraftingCategory());
    }

    /**
     * Tests setting and getting the labels.
     * @covers ::setLabels
     * @covers ::getLabels
     */
    public function testSetAndGetLabels()
    {
        $labels = new LocalisedString();
        $labels->setTranslation('en', 'foo');

        $item = new Recipe();
        $this->assertSame($item, $item->setLabels($labels));
        $this->assertSame($labels, $item->getLabels());
    }

    /**
     * Tests setting and getting the descriptions.
     * @covers ::setDescriptions
     * @covers ::getDescriptions
     */
    public function testSetAndGetDescriptions()
    {
        $descriptions = new LocalisedString();
        $descriptions->setTranslation('en', 'foo');

        $item = new Recipe();
        $this->assertSame($item, $item->setDescriptions($descriptions));
        $this->assertSame($descriptions, $item->getDescriptions());
    }

    /**
     * Tests setting and getting the icon hash.
     * @covers ::setIconHash
     * @covers ::getIconHash
     */
    public function testSetAndGetIconHash()
    {
        $item = new Recipe();
        $this->assertSame($item, $item->setIconHash('foo'));
        $this->assertSame('foo', $item->getIconHash());
    }

    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $ingredient1 = new Ingredient();
        $ingredient1->setType('pqr');
        $ingredient2 = new Ingredient();
        $ingredient2->setType('stu');
        $product1 = new Product();
        $product1->setType('vwx');
        $product2 = new Product();
        $product2->setType('yz');

        $recipe = new Recipe();
        $recipe->setName('abc')
               ->setMode('def')
               ->addIngredient($ingredient1)
               ->addIngredient($ingredient2)
               ->addProduct($product1)
               ->addProduct($product2)
               ->setCraftingTime(13.37)
               ->setIconHash('ghi');
        $recipe->getLabels()->setTranslation('en', 'jkl');
        $recipe->getDescriptions()->setTranslation('de', 'mno');

        $data = [
            'n' => 'abc',
            'm' => 'def',
            'i' => [
                ['t' => 'pqr'],
                ['t' => 'stu']
            ],
            'p' => [
                ['t' => 'vwx'],
                ['t' => 'yz']
            ],
            'c' => 13.37,
            'l' => [
                'en' => 'jkl'
            ],
            'd' => [
                'de' => 'mno'
            ],
            'h' => 'ghi'
        ];

        return [
            [$recipe, $data],
            [new Recipe(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param Recipe $recipe
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Recipe $recipe, array $expectedData)
    {
        $data = $recipe->writeData();
        $this->assertEquals($expectedData, $data);

        $newRecipe = new Recipe();
        $this->assertSame($newRecipe, $newRecipe->readData(new DataContainer($data)));
        $this->assertEquals($newRecipe, $recipe);
    }
}
