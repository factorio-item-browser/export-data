<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Recipe;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use FactorioItemBrowser\ExportData\Utils\HashUtils;
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
    public function testConstruct(): void
    {
        $ingredient = new Ingredient();

        $this->assertSame('', $ingredient->getType());
        $this->assertSame('', $ingredient->getName());
        $this->assertSame(1., $ingredient->getAmount());
        $this->assertSame(0, $ingredient->getOrder());
    }

    /**
     * Tests the cloning.
     * @coversNothing
     */
    public function testClone(): void
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

        $this->assertSame('abc', $clonedIngredient->getType());
        $this->assertSame('def', $clonedIngredient->getName());
        $this->assertSame(13.37, $clonedIngredient->getAmount());
        $this->assertSame(42, $clonedIngredient->getOrder());
    }
    
    /**
     * Tests setting and getting the type.
     * @covers ::setType
     * @covers ::getType
     */
    public function testSetAndGetType(): void
    {
        $ingredient = new Ingredient();
        $this->assertSame($ingredient, $ingredient->setType('foo'));
        $this->assertSame('foo', $ingredient->getType());
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName(): void
    {
        $ingredient = new Ingredient();
        $this->assertSame($ingredient, $ingredient->setName('foo'));
        $this->assertSame('foo', $ingredient->getName());
    }

    /**
     * Tests setting and getting the amount.
     * @covers ::setAmount
     * @covers ::getAmount
     */
    public function testSetAndGetAmount(): void
    {
        $ingredient = new Ingredient();
        $this->assertSame($ingredient, $ingredient->setAmount(13.37));
        $this->assertSame(13.37, $ingredient->getAmount());
    }

    /**
     * Tests setting and getting the order.
     * @covers ::setOrder
     * @covers ::getOrder
     */
    public function testSetAndGetOrder(): void
    {
        $ingredient = new Ingredient();
        $this->assertSame($ingredient, $ingredient->setOrder(42));
        $this->assertSame(42, $ingredient->getOrder());
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
    public function testWriteAndReadData(Ingredient $ingredient, array $expectedData): void
    {
        $data = $ingredient->writeData();
        $this->assertEquals($expectedData, $data);

        $newIngredient = new Ingredient();
        $this->assertSame($newIngredient, $newIngredient->readData(new DataContainer($data)));
        $this->assertEquals($newIngredient, $ingredient);
    }

        /**
     * Tests the calculateHash method.
     * @covers ::calculateHash
     */
    public function testCalculateHash(): void
    {
        $ingredient = new Ingredient();
        $ingredient->setType('abc')
                   ->setName('def')
                   ->setAmount(13.37)
                   ->setOrder(42);

        $expectedResult = HashUtils::calculateHashOfArray([
            'abc',
            'def',
            13.37,
            42,
        ]);

        $result = $ingredient->calculateHash();
        $this->assertSame($expectedResult, $result);
    }
}
