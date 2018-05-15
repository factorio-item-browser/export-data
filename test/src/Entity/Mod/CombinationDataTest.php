<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Mod\CombinationData;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the combination data class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Mod\CombinationData
 */
class CombinationDataTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct()
    {
        $combinationData = new CombinationData();
        $this->assertEquals([], $combinationData->getItems());
        $this->assertEquals([], $combinationData->getRecipes());
        $this->assertEquals([], $combinationData->getIcons());
    }

    /**
     * Tests the cloning.
     * @covers ::__clone
     */
    public function testClone()
    {
        $item = new Item();
        $item->setType('abc')
            ->setName('def');
        $recipe = new Recipe();
        $recipe->setName('ghi')
            ->setMode('jkl');
        $icon = new Icon();
        $icon->setIconHash('mno');

        $combinationData = new CombinationData();
        $combinationData->addItem($item)
                        ->addRecipe($recipe)
                        ->addIcon($icon);

        $clonedCombination = clone($combinationData);
        $item->setType('cba')
             ->setName('fed');
        $recipe->setName('ihg')
               ->setMode('lkj');
        $icon->setIconHash('onm');

        $this->assertInstanceOf(Item::class, $clonedCombination->getItem('abc', 'def'));
        $this->assertInstanceOf(Recipe::class, $clonedCombination->getRecipe('ghi', 'jkl'));
        $this->assertInstanceOf(Icon::class, $clonedCombination->getIcon('mno'));
    }

    /**
     * Tests setting, adding, getting and removing the items.
     * @covers ::setItems
     * @covers ::getItems
     * @covers ::addItem
     * @covers ::getItem
     * @covers ::removeItem
     */
    public function testSetAddGetAndRemoveItems()
    {
        $item1 = new Item();
        $item1->setType('abc')
              ->setName('def');
        $item2 = new Item();
        $item2->setType('ghi')
              ->setName('jkl');
        $item3 = new Item();
        $item3->setType('mno')
              ->setName('pqr');

        $combinationData = new CombinationData();
        $this->assertEquals($combinationData, $combinationData->setItems([$item1, new Recipe(), $item2]));
        $this->assertEquals([$item1, $item2], $combinationData->getItems());
        $this->assertEquals($item1, $combinationData->getItem('abc', 'def'));
        $this->assertEquals($item2, $combinationData->getItem('ghi', 'jkl'));
        $this->assertEquals(null, $combinationData->getItem('mno', 'pqr'));

        $this->assertEquals($combinationData, $combinationData->addItem($item3));
        $this->assertEquals([$item1, $item2, $item3], $combinationData->getItems());
        $this->assertEquals($item1, $combinationData->getItem('abc', 'def'));
        $this->assertEquals($item2, $combinationData->getItem('ghi', 'jkl'));
        $this->assertEquals($item3, $combinationData->getItem('mno', 'pqr'));

        $this->assertEquals($combinationData, $combinationData->removeItem('mno', 'pqr'));
        $this->assertEquals([$item1, $item2], $combinationData->getItems());
        $this->assertEquals($item1, $combinationData->getItem('abc', 'def'));
        $this->assertEquals($item2, $combinationData->getItem('ghi', 'jkl'));
        $this->assertEquals(null, $combinationData->getItem('mno', 'pqr'));
    }

    /**
     * Tests setting, adding, getting and removing the recipes.
     * @covers ::setRecipes
     * @covers ::getRecipes
     * @covers ::addRecipe
     * @covers ::getRecipe
     * @covers ::removeRecipe
     */
    public function testSetAddGetAndRemoveRecipes()
    {
        $recipe1 = new Recipe();
        $recipe1->setName('abc')
                ->setMode('def');
        $recipe2 = new Recipe();
        $recipe2->setName('ghi')
                ->setMode('jkl');
        $recipe3 = new Recipe();
        $recipe3->setName('mno')
                ->setMode('pqr');

        $combinationData = new CombinationData();
        $this->assertEquals($combinationData, $combinationData->setRecipes([$recipe1, new Item(), $recipe2]));
        $this->assertEquals([$recipe1, $recipe2], $combinationData->getRecipes());
        $this->assertEquals($recipe1, $combinationData->getRecipe('abc', 'def'));
        $this->assertEquals($recipe2, $combinationData->getRecipe('ghi', 'jkl'));
        $this->assertEquals(null, $combinationData->getRecipe('mno', 'pqr'));

        $this->assertEquals($combinationData, $combinationData->addRecipe($recipe3));
        $this->assertEquals([$recipe1, $recipe2, $recipe3], $combinationData->getRecipes());
        $this->assertEquals($recipe1, $combinationData->getRecipe('abc', 'def'));
        $this->assertEquals($recipe2, $combinationData->getRecipe('ghi', 'jkl'));
        $this->assertEquals($recipe3, $combinationData->getRecipe('mno', 'pqr'));

        $this->assertEquals($combinationData, $combinationData->removeRecipe('mno', 'pqr'));
        $this->assertEquals([$recipe1, $recipe2], $combinationData->getRecipes());
        $this->assertEquals($recipe1, $combinationData->getRecipe('abc', 'def'));
        $this->assertEquals($recipe2, $combinationData->getRecipe('ghi', 'jkl'));
        $this->assertEquals(null, $combinationData->getRecipe('mno', 'pqr'));
    }

    /**
     * Tests setting, adding, getting and removing the icons.
     * @covers ::setIcons
     * @covers ::getIcons
     * @covers ::addIcon
     * @covers ::getIcon
     * @covers ::removeIcon
     */
    public function testSetAddGetAndRemoveIcons()
    {
        $icon1 = new Icon();
        $icon1->setIconHash('abc');
        $icon2 = new Icon();
        $icon2->setIconHash('def');
        $icon3 = new Icon();
        $icon3->setIconHash('ghi');

        $combinationData = new CombinationData();
        $this->assertEquals($combinationData, $combinationData->setIcons([$icon1, new Item(), $icon2]));
        $this->assertEquals([$icon1, $icon2], $combinationData->getIcons());
        $this->assertEquals($icon1, $combinationData->getIcon('abc'));
        $this->assertEquals($icon2, $combinationData->getIcon('def'));
        $this->assertEquals(null, $combinationData->getIcon('ghi'));

        $this->assertEquals($combinationData, $combinationData->addIcon($icon3));
        $this->assertEquals([$icon1, $icon2, $icon3], $combinationData->getIcons());
        $this->assertEquals($icon1, $combinationData->getIcon('abc'));
        $this->assertEquals($icon2, $combinationData->getIcon('def'));
        $this->assertEquals($icon3, $combinationData->getIcon('ghi'));

        $this->assertEquals($combinationData, $combinationData->removeIcon('ghi'));
        $this->assertEquals([$icon1, $icon2], $combinationData->getIcons());
        $this->assertEquals($icon1, $combinationData->getIcon('abc'));
        $this->assertEquals($icon2, $combinationData->getIcon('def'));
        $this->assertEquals(null, $combinationData->getIcon('ghi'));
    }

    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $item1 = new Item();
        $item1->setType('i42');
        $item2 = new Item();
        $item2->setType('i21');
        $recipe1 = new Recipe();
        $recipe1->setName('r42');
        $recipe2 = new Recipe();
        $recipe2->setName('r21');
        $icon1 = new Icon();
        $icon1->setIconHash('c42');
        $icon2 = new Icon();
        $icon2->setIconHash('c21');

        $combinationData = new CombinationData();
        $combinationData->addItem($item1)
                        ->addItem($item2)
                        ->addRecipe($recipe1)
                        ->addRecipe($recipe2)
                        ->addIcon($icon1)
                        ->addIcon($icon2);

        $data = [
            'i' => [
                ['t' => 'i42'],
                ['t' => 'i21']
            ],
            'r' => [
                ['n' => 'r42'],
                ['n' => 'r21']
            ],
            'c' => [
                ['h' => 'c42'],
                ['h' => 'c21']
            ]
        ];

        return [
            [$combinationData, $data],
            [new CombinationData(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param CombinationData $combinationData
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(CombinationData $combinationData, array $expectedData)
    {
        $data = $combinationData->writeData();
        $this->assertEquals($expectedData, $data);

        $newCombinationData = new CombinationData();
        $this->assertEquals($newCombinationData, $newCombinationData->readData(new DataContainer($data)));
        $this->assertEquals($newCombinationData, $combinationData);
    }
}