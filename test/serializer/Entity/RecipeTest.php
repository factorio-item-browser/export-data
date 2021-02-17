<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Recipe;
use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use FactorioItemBrowser\ExportData\Entity\Recipe\Product;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

/**
 * The test of the serializing the recipe class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class RecipeTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $ingredient1 = new Ingredient();
        $ingredient1->type = 'abc';
        $ingredient1->name = 'def';
        $ingredient2 = new Ingredient();
        $ingredient2->type = 'ghi';
        $ingredient2->name = 'jkl';

        $product1 = new Product();
        $product1->type = 'mno';
        $product1->name = 'pqr';
        $product2 = new Product();
        $product2->type = 'stu';
        $product2->name = 'vwx';

        $recipe = new Recipe();
        $recipe->name = 'yza';
        $recipe->mode = 'bcd';
        $recipe->ingredients = [$ingredient1, $ingredient2];
        $recipe->products = [$product1, $product2];
        $recipe->craftingTime = 13.37;
        $recipe->craftingCategory = 'efg';
        $recipe->iconId = 'hij';
        $recipe->labels->set('klm', 'opq');
        $recipe->descriptions->set('rst', 'uvw');

        return $recipe;
    }

    /**
     * Returns the serialized data.
     * @return array<mixed>
     */
    protected function getData(): array
    {
        return [
            'name' => 'yza',
            'mode' => 'bcd',
            'ingredients' => [
                [
                    'type' => 'abc',
                    'name' => 'def',
                    'amount' => 1.,
                ],
                [
                    'type' => 'ghi',
                    'name' => 'jkl',
                    'amount' => 1.,
                ],
            ],
            'products' => [
                [
                    'type' => 'mno',
                    'name' => 'pqr',
                    'amountMin' => 1.,
                    'amountMax' => 1.,
                    'probability' => 1.,
                ],
                [
                    'type' => 'stu',
                    'name' => 'vwx',
                    'amountMin' => 1.,
                    'amountMax' => 1.,
                    'probability' => 1.,
                ],
            ],
            'craftingTime' => 13.37,
            'craftingCategory' => 'efg',
            'iconId' => 'hij',
            'labels' => [
                'klm' => 'opq',
            ],
            'descriptions' => [
                'rst' => 'uvw',
            ],
        ];
    }
}
