<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\LocalisedString;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use FactorioItemBrowser\ExportData\Entity\Recipe\Product;
use PHPUnit\Framework\MockObject\MockObject;
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
    public function testConstruct(): void
    {
        $recipe = new Recipe();

        $this->assertSame('', $recipe->getName());
        $this->assertSame('', $recipe->getMode());
        $this->assertSame([], $recipe->getIngredients());
        $this->assertSame([], $recipe->getProducts());
        $this->assertSame(0., $recipe->getCraftingTime());
        $this->assertSame('', $recipe->getCraftingCategory());
        $this->assertSame('', $recipe->getIconId());

        // Asserted through type-hints
        $recipe->getLabels();
        $recipe->getDescriptions();
    }

    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $recipe = new Recipe();

        $this->assertSame($recipe, $recipe->setName($name));
        $this->assertSame($name, $recipe->getName());
    }

    /**
     * Tests the setting and getting the mode.
     * @covers ::getMode
     * @covers ::setMode
     */
    public function testSetAndGetMode(): void
    {
        $mode = 'abc';
        $recipe = new Recipe();

        $this->assertSame($recipe, $recipe->setMode($mode));
        $this->assertSame($mode, $recipe->getMode());
    }

    /**
     * Tests setting, adding and getting the ingredients.
     * @covers ::setIngredients
     * @covers ::getIngredients
     * @covers ::addIngredient
     */
    public function testSetAddAndGetIngredients(): void
    {
        /* @var Ingredient&MockObject $ingredient1 */
        $ingredient1 = $this->createMock(Ingredient::class);
        /* @var Ingredient&MockObject $ingredient2 */
        $ingredient2 = $this->createMock(Ingredient::class);
        /* @var Ingredient&MockObject $ingredient3 */
        $ingredient3 = $this->createMock(Ingredient::class);

        $recipe = new Recipe();

        $this->assertSame($recipe, $recipe->setIngredients([$ingredient1, $ingredient2]));
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
    public function testSetAddAndGetProducts(): void
    {
        /* @var Product&MockObject $product1 */
        $product1 = $this->createMock(Product::class);
        /* @var Product&MockObject $product2 */
        $product2 = $this->createMock(Product::class);
        /* @var Product&MockObject $product3 */
        $product3 = $this->createMock(Product::class);

        $recipe = new Recipe();

        $this->assertSame($recipe, $recipe->setProducts([$product1, $product2]));
        $this->assertSame([$product1, $product2], $recipe->getProducts());

        $this->assertSame($recipe, $recipe->addProduct($product3));
        $this->assertSame([$product1, $product2, $product3], $recipe->getProducts());
    }

    /**
     * Tests the setting and getting the crafting time.
     * @covers ::getCraftingTime
     * @covers ::setCraftingTime
     */
    public function testSetAndGetCraftingTime(): void
    {
        $craftingTime = 13.37;
        $recipe = new Recipe();

        $this->assertSame($recipe, $recipe->setCraftingTime($craftingTime));
        $this->assertSame($craftingTime, $recipe->getCraftingTime());
    }

    /**
     * Tests the setting and getting the crafting category.
     * @covers ::getCraftingCategory
     * @covers ::setCraftingCategory
     */
    public function testSetAndGetCraftingCategory(): void
    {
        $craftingCategory = 'abc';
        $recipe = new Recipe();

        $this->assertSame($recipe, $recipe->setCraftingCategory($craftingCategory));
        $this->assertSame($craftingCategory, $recipe->getCraftingCategory());
    }

    /**
     * Tests setting and getting the labels.
     * @covers ::setLabels
     * @covers ::getLabels
     */
    public function testSetAndGetLabels(): void
    {
        /* @var LocalisedString&MockObject $labels */
        $labels = $this->createMock(LocalisedString::class);
        $recipe = new Recipe();

        $this->assertSame($recipe, $recipe->setLabels($labels));
        $this->assertSame($labels, $recipe->getLabels());
    }

    /**
     * Tests setting and getting the descriptions.
     * @covers ::setDescriptions
     * @covers ::getDescriptions
     */
    public function testSetAndGetDescriptions(): void
    {
        /* @var LocalisedString&MockObject $descriptions */
        $descriptions = $this->createMock(LocalisedString::class);
        $recipe = new Recipe();

        $this->assertSame($recipe, $recipe->setDescriptions($descriptions));
        $this->assertSame($descriptions, $recipe->getDescriptions());
    }

    /**
     * Tests the setting and getting the icon id.
     * @covers ::getIconId
     * @covers ::setIconId
     */
    public function testSetAndGetIconId(): void
    {
        $iconId = 'abc';
        $recipe = new Recipe();

        $this->assertSame($recipe, $recipe->setIconId($iconId));
        $this->assertSame($iconId, $recipe->getIconId());
    }
}
