<?php

declare(strict_types=1);

namespace FactorioItemBrowserTestSerializer\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Combination;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Machine;
use FactorioItemBrowser\ExportData\Entity\Mod;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use FactorioItemBrowserTestAsset\ExportData\SerializerTestCase;

/**
 * The test of the serializing the combination class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Combination
 */
class CombinationTest extends SerializerTestCase
{
    /**
     * Returns the object to be serialized or deserialized.
     * @return object
     */
    protected function getObject(): object
    {
        $mod1 = new Mod();
        $mod1->setName('abc');
        $mod2 = new Mod();
        $mod2->setName('def');

        $item1 = new Item();
        $item1->setName('ghi');
        $item2 = new Item();
        $item2->setName('jkl');

        $machine1 = new Machine();
        $machine1->setName('mno');
        $machine2 = new Machine();
        $machine2->setName('pqr');

        $recipe1 = new Recipe();
        $recipe1->setName('stu');
        $recipe2 = new Recipe();
        $recipe2->setName('vwx');

        $icon1 = new Icon();
        $icon1->setHash('yza');
        $icon2 = new Icon();
        $icon2->setHash('bcd');

        $combination = new Combination();
        $combination->setHash('efg')
                    ->setMods([$mod1, $mod2])
                    ->setItems([$item1, $item2])
                    ->setMachines([$machine1, $machine2])
                    ->setRecipes([$recipe1, $recipe2])
                    ->setIcons([$icon1, $icon2]);

        return $combination;
    }

    /**
     * Returns the serialized data.
     * @return array
     */
    protected function getData(): array
    {
        return [
            'hash' => 'efg',
            'mods' => [
                [
                    'name' => 'abc',
                    'titles' => [],
                    'descriptions' => [],
                    'author' => '',
                    'version' => '',
                    'thumbnailHash' => '',
                ],
                [
                    'name' => 'def',
                    'titles' => [],
                    'descriptions' => [],
                    'author' => '',
                    'version' => '',
                    'thumbnailHash' => '',
                ],
            ],
            'items' => [
                [
                    'name' => 'ghi',
                    'type' => '',
                    'labels' => [],
                    'descriptions' => [],
                    'iconHash' => '',
                ],
                [
                    'name' => 'jkl',
                    'type' => '',
                    'labels' => [],
                    'descriptions' => [],
                    'iconHash' => '',
                ],
            ],
            'machines' => [
                [
                    'name' => 'mno',
                    'labels' => [],
                    'descriptions' => [],
                    'craftingCategories' => [],
                    'craftingSpeed' => 1.,
                    'numberOfItemSlots' => 0,
                    'numberOfFluidInputSlots' => 0,
                    'numberOfFluidOutputSlots' => 0,
                    'numberOfModuleSlots' => 0,
                    'energyUsage' => 0.,
                    'energyUsageUnit' => 'W',
                    'iconHash' => '',
                ],
                [
                    'name' => 'pqr',
                    'labels' => [],
                    'descriptions' => [],
                    'craftingCategories' => [],
                    'craftingSpeed' => 1.,
                    'numberOfItemSlots' => 0,
                    'numberOfFluidInputSlots' => 0,
                    'numberOfFluidOutputSlots' => 0,
                    'numberOfModuleSlots' => 0,
                    'energyUsage' => 0.,
                    'energyUsageUnit' => 'W',
                    'iconHash' => '',
                ],
            ],
            'recipes' => [
                [
                    'name' => 'stu',
                    'mode' => '',
                    'ingredients' => [],
                    'products' => [],
                    'craftingTime' => 0.,
                    'craftingCategory' => '',
                    'labels' => [],
                    'descriptions' => [],
                    'iconHash' => '',
                ],
                [
                    'name' => 'vwx',
                    'mode' => '',
                    'ingredients' => [],
                    'products' => [],
                    'craftingTime' => 0.,
                    'craftingCategory' => '',
                    'labels' => [],
                    'descriptions' => [],
                    'iconHash' => '',
                ],
            ],
            'icons' => [
                [
                    'hash' => 'yza',
                    'size' => 0,
                    'renderedSize' => 0,
                    'layers' => [],
                ],
                [
                    'hash' => 'bcd',
                    'size' => 0,
                    'renderedSize' => 0,
                    'layers' => [],
                ],
            ],
        ];
    }
}
