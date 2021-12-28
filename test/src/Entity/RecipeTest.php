<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Collection\TranslationDictionary;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the recipe class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @covers \FactorioItemBrowser\ExportData\Entity\Recipe
 */
class RecipeTest extends TestCase
{
    public function testConstruct(): void
    {
        $recipe = new Recipe();

        $this->assertSame('', $recipe->type);
        $this->assertSame('', $recipe->name);
        $this->assertSame('', $recipe->mode);
        $this->assertSame([], $recipe->ingredients);
        $this->assertSame([], $recipe->products);
        $this->assertSame(0., $recipe->time);
        $this->assertSame('', $recipe->category);
        $this->assertSame('', $recipe->iconId);
    }
}
