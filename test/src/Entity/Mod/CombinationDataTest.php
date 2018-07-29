<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Machine;
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
        $this->assertSame([], $combinationData->getItems());
        $this->assertSame([], $combinationData->getRecipes());
        $this->assertSame([], $combinationData->getMachines());
        $this->assertSame([], $combinationData->getIcons());
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
        $machine = new Machine();
        $machine->setName('mno');
        $icon = new Icon();
        $icon->setHash('pqr');

        $combinationData = new CombinationData();
        $combinationData->addItem($item)
                        ->addRecipe($recipe)
                        ->addMachine($machine)
                        ->addIcon($icon);

        $clonedCombination = clone($combinationData);
        $item->setType('cba')
             ->setName('fed');
        $recipe->setName('ihg')
               ->setMode('lkj');
        $machine->setName('onm');
        $icon->setHash('rqp');

        $this->assertInstanceOf(Item::class, $clonedCombination->getItem('abc', 'def'));
        $this->assertInstanceOf(Recipe::class, $clonedCombination->getRecipe('ghi', 'jkl'));
        $this->assertInstanceOf(Machine::class, $clonedCombination->getMachine('mno'));
        $this->assertInstanceOf(Icon::class, $clonedCombination->getIcon('pqr'));
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
        $this->assertSame($combinationData, $combinationData->setItems([$item1, $item2]));
        $this->assertSame([$item1, $item2], $combinationData->getItems());
        $this->assertSame($item1, $combinationData->getItem('abc', 'def'));
        $this->assertSame($item2, $combinationData->getItem('ghi', 'jkl'));
//        $this->assertNull($combinationData->getItem('mno', 'pqr'));

        $this->assertSame($combinationData, $combinationData->addItem($item3));
        $this->assertSame([$item1, $item2, $item3], $combinationData->getItems());
        $this->assertSame($item1, $combinationData->getItem('abc', 'def'));
        $this->assertSame($item2, $combinationData->getItem('ghi', 'jkl'));
        $this->assertSame($item3, $combinationData->getItem('mno', 'pqr'));

        $this->assertSame($combinationData, $combinationData->removeItem('mno', 'pqr'));
        $this->assertSame([$item1, $item2], $combinationData->getItems());
        $this->assertSame($item1, $combinationData->getItem('abc', 'def'));
        $this->assertSame($item2, $combinationData->getItem('ghi', 'jkl'));
        $this->assertNull($combinationData->getItem('mno', 'pqr'));
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
        $this->assertSame($combinationData, $combinationData->setRecipes([$recipe1, $recipe2]));
        $this->assertSame([$recipe1, $recipe2], $combinationData->getRecipes());
        $this->assertSame($recipe1, $combinationData->getRecipe('abc', 'def'));
        $this->assertSame($recipe2, $combinationData->getRecipe('ghi', 'jkl'));
//        $this->assertNull($combinationData->getRecipe('mno', 'pqr'));

        $this->assertSame($combinationData, $combinationData->addRecipe($recipe3));
        $this->assertSame([$recipe1, $recipe2, $recipe3], $combinationData->getRecipes());
        $this->assertSame($recipe1, $combinationData->getRecipe('abc', 'def'));
        $this->assertSame($recipe2, $combinationData->getRecipe('ghi', 'jkl'));
        $this->assertSame($recipe3, $combinationData->getRecipe('mno', 'pqr'));

        $this->assertSame($combinationData, $combinationData->removeRecipe('mno', 'pqr'));
        $this->assertSame([$recipe1, $recipe2], $combinationData->getRecipes());
        $this->assertSame($recipe1, $combinationData->getRecipe('abc', 'def'));
        $this->assertSame($recipe2, $combinationData->getRecipe('ghi', 'jkl'));
        $this->assertNull($combinationData->getRecipe('mno', 'pqr'));
    }

    /**
     * Tests setting, adding, getting and removing the machines.
     * @covers ::setMachines
     * @covers ::getMachines
     * @covers ::addMachine
     * @covers ::getMachine
     * @covers ::removeMachine
     */
    public function testSetAddGetAndRemoveMachines()
    {
        $machine1 = new Machine();
        $machine1->setName('abc');
        $machine2 = new Machine();
        $machine2->setName('def');
        $machine3 = new Machine();
        $machine3->setName('ghi');

        $combinationData = new CombinationData();
        $this->assertSame($combinationData, $combinationData->setMachines([$machine1, $machine2]));
        $this->assertSame([$machine1, $machine2], $combinationData->getMachines());
        $this->assertSame($machine1, $combinationData->getMachine('abc'));
        $this->assertSame($machine2, $combinationData->getMachine('def'));
//        $this->assertNull($combinationData->getMachine('ghi'));

        $this->assertSame($combinationData, $combinationData->addMachine($machine3));
        $this->assertSame([$machine1, $machine2, $machine3], $combinationData->getMachines());
        $this->assertSame($machine1, $combinationData->getMachine('abc'));
        $this->assertSame($machine2, $combinationData->getMachine('def'));
        $this->assertSame($machine3, $combinationData->getMachine('ghi'));

        $this->assertSame($combinationData, $combinationData->removeMachine('ghi'));
        $this->assertSame([$machine1, $machine2], $combinationData->getMachines());
        $this->assertSame($machine1, $combinationData->getMachine('abc'));
        $this->assertSame($machine2, $combinationData->getMachine('def'));
        $this->assertNull($combinationData->getMachine('ghi'));
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
        $icon1->setHash('abc');
        $icon2 = new Icon();
        $icon2->setHash('def');
        $icon3 = new Icon();
        $icon3->setHash('ghi');

        $combinationData = new CombinationData();
        $this->assertSame($combinationData, $combinationData->setIcons([$icon1, $icon2]));
        $this->assertSame([$icon1, $icon2], $combinationData->getIcons());
        $this->assertSame($icon1, $combinationData->getIcon('abc'));
        $this->assertSame($icon2, $combinationData->getIcon('def'));
//        $this->assertNull($combinationData->getIcon('ghi'));

        $this->assertSame($combinationData, $combinationData->addIcon($icon3));
        $this->assertSame([$icon1, $icon2, $icon3], $combinationData->getIcons());
        $this->assertSame($icon1, $combinationData->getIcon('abc'));
        $this->assertSame($icon2, $combinationData->getIcon('def'));
        $this->assertSame($icon3, $combinationData->getIcon('ghi'));

        $this->assertSame($combinationData, $combinationData->removeIcon('ghi'));
        $this->assertSame([$icon1, $icon2], $combinationData->getIcons());
        $this->assertSame($icon1, $combinationData->getIcon('abc'));
        $this->assertSame($icon2, $combinationData->getIcon('def'));
        $this->assertNull($combinationData->getIcon('ghi'));
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
        $machine1 = new Machine();
        $machine1->setName('m42');
        $machine2 = new Machine();
        $machine2->setName('m21');
        $icon1 = new Icon();
        $icon1->setHash('c42');
        $icon2 = new Icon();
        $icon2->setHash('c21');

        $combinationData = new CombinationData();
        $combinationData->addItem($item1)
                        ->addItem($item2)
                        ->addRecipe($recipe1)
                        ->addRecipe($recipe2)
                        ->addMachine($machine1)
                        ->addMachine($machine2)
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
            'm' => [
                ['n' => 'm42'],
                ['n' => 'm21']
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
        $this->assertSame($newCombinationData, $newCombinationData->readData(new DataContainer($data)));
        $this->assertEquals($newCombinationData, $combinationData);
    }
}
