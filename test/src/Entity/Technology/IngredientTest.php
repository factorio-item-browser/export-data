<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Technology;

use FactorioItemBrowser\ExportData\Entity\Technology\Ingredient;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ingredient class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @covers \FactorioItemBrowser\ExportData\Entity\Technology\Ingredient
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
