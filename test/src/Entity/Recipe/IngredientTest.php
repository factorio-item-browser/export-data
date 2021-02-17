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
 * @covers \FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient
 */
class IngredientTest extends TestCase
{
    public function testConstruct(): void
    {
        $ingredient = new Ingredient();

        $this->assertSame('', $ingredient->type);
        $this->assertSame('', $ingredient->name);
        $this->assertSame(1., $ingredient->amount);
    }
}
