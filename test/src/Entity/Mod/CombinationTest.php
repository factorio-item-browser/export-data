<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Mod\Combination;
use FactorioItemBrowser\ExportData\Utils\EntityUtils;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the combination class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Mod\Combination
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
        $this->assertSame('', $combination->getName());
        $this->assertSame('', $combination->getMainModName());
        $this->assertSame([], $combination->getLoadedModNames());
        $this->assertSame([], $combination->getLoadedOptionalModNames());
        $this->assertSame([], $combination->getItemHashes());
        $this->assertSame([], $combination->getRecipeHashes());
        $this->assertSame([], $combination->getMachineHashes());
        $this->assertSame([], $combination->getIconHashes());
    }

    /**
     * Tests the cloning.
     * @coversNothing
     */
    public function testClone(): void
    {
        $item = new Item();
        $item->setType('foo')
             ->setName('bar');

        $combination = new Combination();
        $combination->setName('abc')
                    ->setMainModName('def')
                    ->setLoadedModNames(['ghi'])
                    ->setLoadedOptionalModNames(['jkl'])
                    ->setItemHashes(['mno'])
                    ->setRecipeHashes(['pqr'])
                    ->setMachineHashes(['stu'])
                    ->setIconHashes(['vwx']);

        $clonedCombination = clone($combination);
        $combination->setName('cba')
                    ->setMainModName('fed')
                    ->setLoadedModNames(['ihg'])
                    ->setLoadedOptionalModNames(['lkj'])
                    ->setItemHashes(['onm'])
                    ->setRecipeHashes(['rqp'])
                    ->setMachineHashes(['uts'])
                    ->setIconHashes(['xwv']);


        $this->assertSame('abc', $clonedCombination->getName());
        $this->assertSame('def', $clonedCombination->getMainModName());
        $this->assertSame(['ghi'], $clonedCombination->getLoadedModNames());
        $this->assertSame(['jkl'], $clonedCombination->getLoadedOptionalModNames());
        $this->assertSame(['mno'], $clonedCombination->getItemHashes());
        $this->assertSame(['pqr'], $clonedCombination->getRecipeHashes());
        $this->assertSame(['stu'], $clonedCombination->getMachineHashes());
        $this->assertSame(['vwx'], $clonedCombination->getIconHashes());
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName(): void
    {
        $combination = new Combination();
        $this->assertSame($combination, $combination->setName('foo'));
        $this->assertSame('foo', $combination->getName());
    }

    /**
     * Tests setting and getting the mainModName.
     * @covers ::setMainModName
     * @covers ::getMainModName
     */
    public function testSetAndGetMainModName(): void
    {
        $combination = new Combination();
        $this->assertSame($combination, $combination->setMainModName('foo'));
        $this->assertSame('foo', $combination->getMainModName());
    }

    /**
     * Tests setting, adding and getting the loaded mod names.
     * @covers ::setLoadedModNames
     * @covers ::getLoadedModNames
     * @covers ::addLoadedModName
     */
    public function testSetAddAndGetLoadedModNames(): void
    {
        $combination = new Combination();
        $this->assertSame($combination, $combination->setLoadedModNames(['abc', 'def']));
        $this->assertSame(['abc', 'def'], $combination->getLoadedModNames());

        $this->assertSame($combination, $combination->addLoadedModName('ghi'));
        $this->assertSame(['abc', 'def', 'ghi'], $combination->getLoadedModNames());
    }

    /**
     * Tests setting, adding and getting the loaded optional mod names.
     * @covers ::setLoadedOptionalModNames
     * @covers ::getLoadedOptionalModNames
     * @covers ::addLoadedOptionalModName
     */
    public function testSetAddAndGetLoadedOptionalModNames(): void
    {
        $combination = new Combination();
        $this->assertSame($combination, $combination->setLoadedOptionalModNames(['abc', 'def']));
        $this->assertSame(['abc', 'def'], $combination->getLoadedOptionalModNames());

        $this->assertSame($combination, $combination->addLoadedOptionalModName('ghi'));
        $this->assertSame(['abc', 'def', 'ghi'], $combination->getLoadedOptionalModNames());
    }

    /**
     * Tests setting, adding and getting the item hashes.
     * @covers ::setItemHashes
     * @covers ::getItemHashes
     * @covers ::addItemHash
     */
    public function testSetAddAndGetItemHashes(): void
    {
        $combination = new Combination();
        $this->assertSame($combination, $combination->setItemHashes(['abc', 'def']));
        $this->assertSame(['abc', 'def'], $combination->getItemHashes());

        $this->assertSame($combination, $combination->addItemHash('ghi'));
        $this->assertSame(['abc', 'def', 'ghi'], $combination->getItemHashes());
    }

    /**
     * Tests setting, adding and getting the recipe hashes.
     * @covers ::setRecipeHashes
     * @covers ::getRecipeHashes
     * @covers ::addRecipeHash
     */
    public function testSetAddAndGetRecipeHashes(): void
    {
        $combination = new Combination();
        $this->assertSame($combination, $combination->setRecipeHashes(['abc', 'def']));
        $this->assertSame(['abc', 'def'], $combination->getRecipeHashes());

        $this->assertSame($combination, $combination->addRecipeHash('ghi'));
        $this->assertSame(['abc', 'def', 'ghi'], $combination->getRecipeHashes());
    }

    /**
     * Tests setting, adding and getting the machine hashes.
     * @covers ::setMachineHashes
     * @covers ::getMachineHashes
     * @covers ::addMachineHash
     */
    public function testSetAddAndGetMachineHashes(): void
    {
        $combination = new Combination();
        $this->assertSame($combination, $combination->setMachineHashes(['abc', 'def']));
        $this->assertSame(['abc', 'def'], $combination->getMachineHashes());

        $this->assertSame($combination, $combination->addMachineHash('ghi'));
        $this->assertSame(['abc', 'def', 'ghi'], $combination->getMachineHashes());
    }

    /**
     * Tests setting, adding and getting the icon hashes.
     * @covers ::setIconHashes
     * @covers ::getIconHashes
     * @covers ::addIconHash
     */
    public function testSetAddAndGetIconHashes(): void
    {
        $combination = new Combination();
        $this->assertSame($combination, $combination->setIconHashes(['abc', 'def']));
        $this->assertSame(['abc', 'def'], $combination->getIconHashes());

        $this->assertSame($combination, $combination->addIconHash('ghi'));
        $this->assertSame(['abc', 'def', 'ghi'], $combination->getIconHashes());
    }
    
    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $combination = new Combination();
        $combination->setName('abc')
                    ->setMainModName('def')
                    ->addLoadedModName('ghi')
                    ->addLoadedModName('jkl')
                    ->addLoadedOptionalModName('mno')
                    ->addLoadedOptionalModName('pqr')
                    ->addItemHash('stu')
                    ->addItemHash('vwx')
                    ->addRecipeHash('yza')
                    ->addRecipeHash('bcd')
                    ->addMachineHash('efg')
                    ->addMachineHash('hij')
                    ->addIconHash('klm')
                    ->addIconHash('opq');

        $data = [
            'n' => 'abc',
            'm' => 'def',
            'l' => [
                'ghi',
                'jkl',
            ],
            'o' => [
                'mno',
                'pqr',
            ],
            'i' => [
                'stu',
                'vwx',
            ],
            'r' => [
                'yza',
                'bcd',
            ],
            'a' => [
                'efg',
                'hij',
            ],
            'c' => [
                'klm',
                'opq',
            ],
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
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Combination $combination, array $expectedData): void
    {
        $data = $combination->writeData();
        $this->assertEquals($expectedData, $data);

        $newCombination = new Combination();
        $this->assertSame($newCombination, $newCombination->readData(new DataContainer($data)));
        $this->assertEquals($newCombination, $combination);
    }

    /**
     * Tests the calculateHash method.
     * @covers ::calculateHash
     */
    public function testCalculateHash(): void
    {
        $combination = new Combination();
        $combination->setName('abc')
                    ->setMainModName('def')
                    ->addLoadedModName('ghi')
                    ->addLoadedModName('jkl')
                    ->addLoadedOptionalModName('mno')
                    ->addLoadedOptionalModName('pqr')
                    ->addItemHash('stu')
                    ->addItemHash('vwx')
                    ->addRecipeHash('yza')
                    ->addRecipeHash('bcd')
                    ->addMachineHash('efg')
                    ->addMachineHash('hij')
                    ->addIconHash('klm')
                    ->addIconHash('opq');

        $expectedResult = EntityUtils::calculateHashOfArray([
            'abc',
            'def',
            ['ghi', 'jkl'],
            ['mno', 'pqr'],
        ]);

        $result = $combination->calculateHash();
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the getIdentifier method.
     * @covers ::getIdentifier
     */
    public function testGetIdentifier(): void
    {
        $combination = new Combination();
        $combination->setName('abc');

        $result = $combination->getIdentifier();
        $this->assertSame('abc', $result);
    }
}
