<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Recipe;

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
    public function testConstruct(): void
    {
        $ingredient = new Ingredient();

        $this->assertSame('', $ingredient->getType());
        $this->assertSame('', $ingredient->getName());
        $this->assertSame(1., $ingredient->getAmount());
    }

    /**
     * Tests the setting and getting the type.
     * @covers ::getType
     * @covers ::setType
     */
    public function testSetAndGetType(): void
    {
        $type = 'abc';
        $ingredient = new Ingredient();

        $this->assertSame($ingredient, $ingredient->setType($type));
        $this->assertSame($type, $ingredient->getType());
    }

    /**
     * Tests the setting and getting the name.
     * @covers ::getName
     * @covers ::setName
     */
    public function testSetAndGetName(): void
    {
        $name = 'abc';
        $ingredient = new Ingredient();

        $this->assertSame($ingredient, $ingredient->setName($name));
        $this->assertSame($name, $ingredient->getName());
    }

    /**
     * Tests the setting and getting the amount.
     * @covers ::getAmount
     * @covers ::setAmount
     */
    public function testSetAndGetAmount(): void
    {
        $amount = 13.37;
        $ingredient = new Ingredient();

        $this->assertSame($ingredient, $ingredient->setAmount($amount));
        $this->assertSame($amount, $ingredient->getAmount());
    }
}
