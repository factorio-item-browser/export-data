<?php

namespace FactorioItemBrowserTest\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Mod\Combination;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the combination class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass FactorioItemBrowser\ExportData\Entity\Mod\Combination
 */
class CombinationTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $combination = new Combination();
        $this->assertEquals('', $combination->getName());
        $this->assertEquals('', $combination->getMainModName());
        $this->assertEquals([], $combination->getLoadedModNames());
        $this->assertEquals([], $combination->getLoadedOptionalModNames());
        $this->assertEquals([], $combination->getItems());
        $this->assertEquals([], $combination->getRecipes());
        $this->assertEquals([], $combination->getIcons());
    }

    /**
     * Tests the cloning.
     */
    public function testClone()
    {
        $item = new Item();
        $item->setType('abc')
             ->setName('def');
        $recipe = new Recipe();
        $recipe->setType('ghi')
               ->setName('jkl');
        $icon = new Icon();
        $icon->setIconHash('mno');

        $combination = new Combination();
        $combination->setName('pqr')
                    ->setMainModName('stu')
                    ->setLoadedModNames(['vwx'])
                    ->setLoadedOptionalModNames(['yz'])
                    ->addItem($item)
                    ->addRecipe($recipe)
                    ->addIcon($icon);

        $clonedCombination = clone($combination);
        $combination->setName('rqp')
                    ->setMainModName('uts')
                    ->setLoadedModNames(['xwv'])
                    ->setLoadedOptionalModNames(['zy']);
        $item->setType('cba')
             ->setName('fed');
        $recipe->setType('ihg')
               ->setName('lkj');
        $icon->setIconHash('onm');

        $this->assertEquals('pqr', $clonedCombination->getName());
        $this->assertEquals('stu', $clonedCombination->getMainModName());
        $this->assertEquals(['vwx'], $clonedCombination->getLoadedModNames());
        $this->assertEquals(['yz'], $clonedCombination->getLoadedOptionalModNames());
        $this->assertInstanceOf(Item::class, $clonedCombination->getItem('abc', 'def'));
        $this->assertInstanceOf(Recipe::class, $clonedCombination->getRecipe('ghi', 'jkl'));
        $this->assertInstanceOf(Icon::class, $clonedCombination->getIcon('mno'));
    }

    /**
     * Tests setting and getting the name.
     */
    public function testSetAndGetName()
    {
        $combination = new Combination();
        $this->assertEquals($combination, $combination->setName('foo'));
        $this->assertEquals('foo', $combination->getName());
    }

    /**
     * Tests setting and getting the mainModName.
     */
    public function testSetAndGetMainModName()
    {
        $combination = new Combination();
        $this->assertEquals($combination, $combination->setMainModName('foo'));
        $this->assertEquals('foo', $combination->getMainModName());
    }

    /**
     * Tests setting, adding and getting the loaded mod names.
     */
    public function testSetAddAndGetLoadedModNames()
    {
        $combination = new Combination();
        $this->assertEquals($combination, $combination->setLoadedModNames(['abc', 'def']));
        $this->assertEquals(['abc', 'def'], $combination->getLoadedModNames());

        $this->assertEquals($combination, $combination->addLoadedModName('ghi'));
        $this->assertEquals(['abc', 'def', 'ghi'], $combination->getLoadedModNames());
    }

    /**
     * Tests setting, adding and getting the loaded optional mod names.
     */
    public function testSetAddAndGetLoadedOptionalModNames()
    {
        $combination = new Combination();
        $this->assertEquals($combination, $combination->setLoadedOptionalModNames(['abc', 'def']));
        $this->assertEquals(['abc', 'def'], $combination->getLoadedOptionalModNames());

        $this->assertEquals($combination, $combination->addLoadedOptionalModName('ghi'));
        $this->assertEquals(['abc', 'def', 'ghi'], $combination->getLoadedOptionalModNames());
    }

    /**
     * Tests setting, adding, getting and removing the items.
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

        $combination = new Combination();
        $this->assertEquals($combination, $combination->setItems([$item1, new Recipe(), $item2]));
        $this->assertEquals([$item1, $item2], $combination->getItems());
        $this->assertEquals($item1, $combination->getItem('abc', 'def'));
        $this->assertEquals($item2, $combination->getItem('ghi', 'jkl'));
        $this->assertEquals(null, $combination->getItem('mno', 'pqr'));

        $this->assertEquals($combination, $combination->addItem($item3));
        $this->assertEquals([$item1, $item2, $item3], $combination->getItems());
        $this->assertEquals($item1, $combination->getItem('abc', 'def'));
        $this->assertEquals($item2, $combination->getItem('ghi', 'jkl'));
        $this->assertEquals($item3, $combination->getItem('mno', 'pqr'));

        $this->assertEquals($combination, $combination->removeItem('mno', 'pqr'));
        $this->assertEquals([$item1, $item2], $combination->getItems());
        $this->assertEquals($item1, $combination->getItem('abc', 'def'));
        $this->assertEquals($item2, $combination->getItem('ghi', 'jkl'));
        $this->assertEquals(null, $combination->getItem('mno', 'pqr'));
    }

    /**
     * Tests setting, adding, getting and removing the recipes.
     */
    public function testSetAddGetAndRemoveRecipes()
    {
        $recipe1 = new Recipe();
        $recipe1->setType('abc')
                ->setName('def');
        $recipe2 = new Recipe();
        $recipe2->setType('ghi')
                ->setName('jkl');
        $recipe3 = new Recipe();
        $recipe3->setType('mno')
                ->setName('pqr');

        $combination = new Combination();
        $this->assertEquals($combination, $combination->setRecipes([$recipe1, new Item(), $recipe2]));
        $this->assertEquals([$recipe1, $recipe2], $combination->getRecipes());
        $this->assertEquals($recipe1, $combination->getRecipe('abc', 'def'));
        $this->assertEquals($recipe2, $combination->getRecipe('ghi', 'jkl'));
        $this->assertEquals(null, $combination->getRecipe('mno', 'pqr'));

        $this->assertEquals($combination, $combination->addRecipe($recipe3));
        $this->assertEquals([$recipe1, $recipe2, $recipe3], $combination->getRecipes());
        $this->assertEquals($recipe1, $combination->getRecipe('abc', 'def'));
        $this->assertEquals($recipe2, $combination->getRecipe('ghi', 'jkl'));
        $this->assertEquals($recipe3, $combination->getRecipe('mno', 'pqr'));

        $this->assertEquals($combination, $combination->removeRecipe('mno', 'pqr'));
        $this->assertEquals([$recipe1, $recipe2], $combination->getRecipes());
        $this->assertEquals($recipe1, $combination->getRecipe('abc', 'def'));
        $this->assertEquals($recipe2, $combination->getRecipe('ghi', 'jkl'));
        $this->assertEquals(null, $combination->getRecipe('mno', 'pqr'));
    }

    /**
     * Tests setting, adding, getting and removing the icons.
     */
    public function testSetAddGetAndRemoveIcons()
    {
        $icon1 = new Icon();
        $icon1->setIconHash('abc');
        $icon2 = new Icon();
        $icon2->setIconHash('def');
        $icon3 = new Icon();
        $icon3->setIconHash('ghi');

        $combination = new Combination();
        $this->assertEquals($combination, $combination->setIcons([$icon1, new Item(), $icon2]));
        $this->assertEquals([$icon1, $icon2], $combination->getIcons());
        $this->assertEquals($icon1, $combination->getIcon('abc'));
        $this->assertEquals($icon2, $combination->getIcon('def'));
        $this->assertEquals(null, $combination->getIcon('ghi'));

        $this->assertEquals($combination, $combination->addIcon($icon3));
        $this->assertEquals([$icon1, $icon2, $icon3], $combination->getIcons());
        $this->assertEquals($icon1, $combination->getIcon('abc'));
        $this->assertEquals($icon2, $combination->getIcon('def'));
        $this->assertEquals($icon3, $combination->getIcon('ghi'));

        $this->assertEquals($combination, $combination->removeIcon('ghi'));
        $this->assertEquals([$icon1, $icon2], $combination->getIcons());
        $this->assertEquals($icon1, $combination->getIcon('abc'));
        $this->assertEquals($icon2, $combination->getIcon('def'));
        $this->assertEquals(null, $combination->getIcon('ghi'));
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
        $recipe1->setType('r42');
        $recipe2 = new Recipe();
        $recipe2->setType('r21');
        $icon1 = new Icon();
        $icon1->setIconHash('c42');
        $icon2 = new Icon();
        $icon2->setIconHash('c21');

        $combination = new Combination();
        $combination->setName('abc')
                    ->setMainModName('def')
                    ->addLoadedModName('ghi')
                    ->addLoadedModName('jkl')
                    ->addLoadedOptionalModName('mno')
                    ->addLoadedOptionalModName('pqr')
                    ->addItem($item1)
                    ->addItem($item2)
                    ->addRecipe($recipe1)
                    ->addRecipe($recipe2)
                    ->addIcon($icon1)
                    ->addIcon($icon2);

        $data = [
            'n' => 'abc',
            'm' => 'def',
            'l' => [
                'ghi',
                'jkl'
            ],
            'o' => [
                'mno',
                'pqr'
            ],
            'i' => [
                ['t' => 'i42'],
                ['t' => 'i21']
            ],
            'r' => [
                ['t' => 'r42'],
                ['t' => 'r21']
            ],
            'c' => [
                ['h' => 'c42'],
                ['h' => 'c21']
            ]
        ];

        return [
            [$combination, $data],
            [new Combination(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param Combination $combination
     * @param array $expectedData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Combination $combination, array $expectedData)
    {
        $data = $combination->writeData();
        $this->assertEquals($expectedData, $data);

        $newCombination = new Combination();
        $this->assertEquals($newCombination, $newCombination->readData(new DataContainer($data)));
        $this->assertEquals($newCombination, $combination);
    }
}
