<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity\Recipe;

use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

/**
 * The test of the serializing the ingredient class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class IngredientTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $ingredient = new Ingredient();
        $ingredient->type = 'abc';
        $ingredient->name = 'def';
        $ingredient->amount = 13.37;
        return $ingredient;
    }

    protected function getData(): array
    {
        return [
            'type' => 'abc',
            'name' => 'def',
            'amount' => 13.37,
        ];
    }

    protected function getHashData(): array
    {
        return $this->getData();
    }
}
