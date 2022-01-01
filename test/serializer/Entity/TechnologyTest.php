<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Recipe\Ingredient;
use FactorioItemBrowser\ExportData\Entity\Technology;
use FactorioItemBrowserTestSerializer\ExportData\SerializerTestCase;

/**
 * The serializer test of the Technology class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class TechnologyTest extends SerializerTestCase
{
    protected function getObject(): object
    {
        $ingredient1 = new Ingredient();
        $ingredient1->type = 'abc';
        $ingredient1->name = 'def';
        $ingredient2 = new Ingredient();
        $ingredient2->type = 'ghi';
        $ingredient2->name = 'jkl';

        $object = new Technology();
        $object->name = 'mno';
        $object->mode = 'pqr';
        $object->prerequisites = ['stu', 'vwx'];
        $object->researchIngredients = [$ingredient1, $ingredient2];
        $object->researchCount = 1337;
        $object->researchCountFormula = 'zab';
        $object->researchTime = 13.37;
        $object->level = 12;
        $object->maxLevel = 34;
        $object->unlockedRecipes = ['yza', 'bcd'];
        $object->iconId = 'efg';
        $object->localisedName = ['hij', 42];
        $object->localisedDescription = ['klm', 21];
        $object->labels->set('nop', 'qrs');
        $object->descriptions->set('tuv', 'wxy');
        return $object;
    }

    protected function getData(): array
    {
        return [
            'name' => 'mno',
            'mode' => 'pqr',
            'prerequisites' => ['stu', 'vwx'],
            'researchIngredients' => [
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
            'researchCount' => '1337',
            'researchCountFormula' => 'zab',
            'researchTime' => 13.37,
            'level' => 12,
            'maxLevel' => 34,
            'unlockedRecipes' => ['yza', 'bcd'],
            'iconId' => 'efg',
            'localisedName' => ['hij', 42],
            'localisedDescription' => ['klm', 21],
            'labels' => [
                'nop' => 'qrs',
            ],
            'descriptions' => [
                'tuv' => 'wxy',
            ],
        ];
    }

    protected function getHashData(): array
    {
        return [
            'name' => 'mno',
            'prerequisites' => ['stu', 'vwx'],
            'researchIngredients' => [
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
            'researchCount' => 1337,
            'researchCountFormula' => 'zab',
            'researchTime' => 13.37,
            'level' => 12,
            'maxLevel' => 34,
            'unlockedRecipes' => ['yza', 'bcd'],
            'localisedName' => ['hij', 42],
            'localisedDescription' => ['klm', 21],
        ];
    }
}
