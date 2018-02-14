<?php

namespace FactorioItemBrowserTest\ExportData\Entity\Recipe;

use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ingredient class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * 
 * @coversDefaultClass FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient
 */
class IngredientTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $ingredient = new Ingredient();

        $this->assertEquals('', $ingredient->getType());
        $this->assertEquals('', $ingredient->getName());
        $this->assertEquals(0., $ingredient->getAmount());
        $this->assertEquals(0, $ingredient->getOrder());
    }

    /**
     * Tests setting and getting the type.
     */
    public function testSetAndGetType()
    {
        $ingredient = new Ingredient();
        $this->assertEquals($ingredient, $ingredient->setType('foo'));
        $this->assertEquals('foo', $ingredient->getType());
    }

    /**
     * Tests setting and getting the name.
     */
    public function testSetAndGetName()
    {
        $ingredient = new Ingredient();
        $this->assertEquals($ingredient, $ingredient->setName('foo'));
        $this->assertEquals('foo', $ingredient->getName());
    }

    /**
     * Tests setting and getting the amount.
     */
    public function testSetAndGetAmount()
    {
        $ingredient = new Ingredient();
        $this->assertEquals($ingredient, $ingredient->setAmount(13.37));
        $this->assertEquals(13.37, $ingredient->getAmount());
    }

    /**
     * Tests setting and getting the order.
     */
    public function testSetAndGetOrder()
    {
        $ingredient = new Ingredient();
        $this->assertEquals($ingredient, $ingredient->setOrder(42));
        $this->assertEquals(42, $ingredient->getOrder());
    }
}
