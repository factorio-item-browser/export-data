<?php

namespace FactorioItemBrowserTest\ExportData\Entity\Recipe;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ingredient class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient
 */
class IngredientTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $ingredient = new Ingredient();

        $this->assertEquals('', $ingredient->getType());
        $this->assertEquals('', $ingredient->getName());
        $this->assertEquals(1., $ingredient->getAmount());
        $this->assertEquals(0, $ingredient->getOrder());
    }

    /**
     * Tests the cloning.
     * @coversNothing
     */
    public function testClone()
    {
        $ingredient = new Ingredient();
        $ingredient->setType('abc')
                   ->setName('def')
                   ->setAmount(13.37)
                   ->setOrder(42);

        $clonedIngredient = clone($ingredient);
        $ingredient->setType('cba')
                   ->setName('fed')
                   ->setAmount(73.31)
                   ->setOrder(24);

        $this->assertEquals('abc', $clonedIngredient->getType());
        $this->assertEquals('def', $clonedIngredient->getName());
        $this->assertEquals(13.37, $clonedIngredient->getAmount());
        $this->assertEquals(42, $clonedIngredient->getOrder());
    }
    
    /**
     * Tests setting and getting the type.
     * @covers ::setType
     * @covers ::getType
     */
    public function testSetAndGetType()
    {
        $ingredient = new Ingredient();
        $this->assertEquals($ingredient, $ingredient->setType('foo'));
        $this->assertEquals('foo', $ingredient->getType());
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName()
    {
        $ingredient = new Ingredient();
        $this->assertEquals($ingredient, $ingredient->setName('foo'));
        $this->assertEquals('foo', $ingredient->getName());
    }

    /**
     * Tests setting and getting the amount.
     * @covers ::setAmount
     * @covers ::getAmount
     */
    public function testSetAndGetAmount()
    {
        $ingredient = new Ingredient();
        $this->assertEquals($ingredient, $ingredient->setAmount(13.37));
        $this->assertEquals(13.37, $ingredient->getAmount());
    }

    /**
     * Tests setting and getting the order.
     * @covers ::setOrder
     * @covers ::getOrder
     */
    public function testSetAndGetOrder()
    {
        $ingredient = new Ingredient();
        $this->assertEquals($ingredient, $ingredient->setOrder(42));
        $this->assertEquals(42, $ingredient->getOrder());
    }

    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $ingredient = new Ingredient();
        $ingredient->setType('abc')
                   ->setName('def')
                   ->setAmount(13.37)
                   ->setOrder(42);

        $data = [
            't' => 'abc',
            'n' => 'def',
            'a' => 13.37,
            'o' => 42
        ];

        return [
            [$ingredient, $data],
            [new Ingredient(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param Ingredient $ingredient
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Ingredient $ingredient, array $expectedData)
    {
        $data = $ingredient->writeData();
        $this->assertEquals($expectedData, $data);

        $newIngredient = new Ingredient();
        $this->assertEquals($newIngredient, $newIngredient->readData(new DataContainer($data)));
        $this->assertEquals($newIngredient, $ingredient);
    }
}
