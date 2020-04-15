<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\Combination;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Machine;
use FactorioItemBrowser\ExportData\Entity\Mod;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the Combination class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Combination
 */
class CombinationTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $combination = new Combination();

        $this->assertSame('', $combination->getId());
        $this->assertSame([], $combination->getMods());
        $this->assertSame([], $combination->getItems());
        $this->assertSame([], $combination->getMachines());
        $this->assertSame([], $combination->getRecipes());
        $this->assertSame([], $combination->getIcons());
    }

    /**
     * Tests the setting and getting the id.
     * @covers ::getId
     * @covers ::setId
     */
    public function testSetAndGetId(): void
    {
        $id = 'abc';
        $combination = new Combination();

        $this->assertSame($combination, $combination->setId($id));
        $this->assertSame($id, $combination->getId());
    }

    /**
     * Tests setting, adding and getting the mods.
     * @covers ::setMods
     * @covers ::getMods
     * @covers ::addMod
     */
    public function testSetAddAndGetMods(): void
    {
        /* @var Mod&MockObject $mod1 */
        $mod1 = $this->createMock(Mod::class);
        /* @var Mod&MockObject $mod2 */
        $mod2 = $this->createMock(Mod::class);
        /* @var Mod&MockObject $mod3 */
        $mod3 = $this->createMock(Mod::class);

        $combination = new Combination();

        $this->assertSame($combination, $combination->setMods([$mod1, $mod2]));
        $this->assertSame([$mod1, $mod2], $combination->getMods());

        $this->assertSame($combination, $combination->addMod($mod3));
        $this->assertSame([$mod1, $mod2, $mod3], $combination->getMods());
    }

    /**
     * Tests setting, adding and getting the items.
     * @covers ::setItems
     * @covers ::getItems
     * @covers ::addItem
     */
    public function testSetAddAndGetItems(): void
    {
        /* @var Item&MockObject $item1 */
        $item1 = $this->createMock(Item::class);
        /* @var Item&MockObject $item2 */
        $item2 = $this->createMock(Item::class);
        /* @var Item&MockObject $item3 */
        $item3 = $this->createMock(Item::class);

        $combination = new Combination();

        $this->assertSame($combination, $combination->setItems([$item1, $item2]));
        $this->assertSame([$item1, $item2], $combination->getItems());

        $this->assertSame($combination, $combination->addItem($item3));
        $this->assertSame([$item1, $item2, $item3], $combination->getItems());
    }

    /**
     * Tests setting, adding and getting the machines.
     * @covers ::setMachines
     * @covers ::getMachines
     * @covers ::addMachine
     */
    public function testSetAddAndGetMachines(): void
    {
        /* @var Machine&MockObject $machine1 */
        $machine1 = $this->createMock(Machine::class);
        /* @var Machine&MockObject $machine2 */
        $machine2 = $this->createMock(Machine::class);
        /* @var Machine&MockObject $machine3 */
        $machine3 = $this->createMock(Machine::class);

        $combination = new Combination();

        $this->assertSame($combination, $combination->setMachines([$machine1, $machine2]));
        $this->assertSame([$machine1, $machine2], $combination->getMachines());

        $this->assertSame($combination, $combination->addMachine($machine3));
        $this->assertSame([$machine1, $machine2, $machine3], $combination->getMachines());
    }

    /**
     * Tests setting, adding and getting the recipes.
     * @covers ::setRecipes
     * @covers ::getRecipes
     * @covers ::addRecipe
     */
    public function testSetAddAndGetRecipes(): void
    {
        /* @var Recipe&MockObject $recipe1 */
        $recipe1 = $this->createMock(Recipe::class);
        /* @var Recipe&MockObject $recipe2 */
        $recipe2 = $this->createMock(Recipe::class);
        /* @var Recipe&MockObject $recipe3 */
        $recipe3 = $this->createMock(Recipe::class);

        $combination = new Combination();

        $this->assertSame($combination, $combination->setRecipes([$recipe1, $recipe2]));
        $this->assertSame([$recipe1, $recipe2], $combination->getRecipes());

        $this->assertSame($combination, $combination->addRecipe($recipe3));
        $this->assertSame([$recipe1, $recipe2, $recipe3], $combination->getRecipes());
    }

    /**
     * Tests setting, adding and getting the icons.
     * @covers ::setIcons
     * @covers ::getIcons
     * @covers ::addIcon
     */
    public function testSetAddAndGetIcons(): void
    {
        /* @var Icon&MockObject $icon1 */
        $icon1 = $this->createMock(Icon::class);
        /* @var Icon&MockObject $icon2 */
        $icon2 = $this->createMock(Icon::class);
        /* @var Icon&MockObject $icon3 */
        $icon3 = $this->createMock(Icon::class);

        $combination = new Combination();

        $this->assertSame($combination, $combination->setIcons([$icon1, $icon2]));
        $this->assertSame([$icon1, $icon2], $combination->getIcons());

        $this->assertSame($combination, $combination->addIcon($icon3));
        $this->assertSame([$icon1, $icon2, $icon3], $combination->getIcons());
    }
}
