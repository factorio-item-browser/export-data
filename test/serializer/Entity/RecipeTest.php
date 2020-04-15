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
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Recipe
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
        $ingredient1->setType('abc')
                    ->setName('def');
        $ingredient2 = new Ingredient();
        $ingredient2->setType('ghi')
                    ->setName('jkl');

        $product1 = new Product();
        $product1->setType('mno')
                 ->setName('pqr');
        $product2 = new Product();
        $product2->setType('stu')
                 ->setName('vwx');

        $recipe = new Recipe();
        $recipe->setName('yza')
               ->setMode('bcd')
               ->setIngredients([$ingredient1, $ingredient2])
               ->setProducts([$product1, $product2])
               ->setCraftingTime(13.37)
               ->setCraftingCategory('efg')
               ->setIconId('hij');
        $recipe->getLabels()->addTranslation('klm', 'opq');
        $recipe->getDescriptions()->addTranslation('rst', 'uvw');

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
