<?php

namespace FactorioItemBrowserTest\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Mod\Combination;
use FactorioItemBrowser\ExportData\Entity\Mod\CombinationData;
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
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $combination = new Combination();
        $this->assertEquals('', $combination->getName());
        $this->assertEquals('', $combination->getMainModName());
        $this->assertEquals([], $combination->getLoadedModNames());
        $this->assertEquals([], $combination->getLoadedOptionalModNames());
        $this->assertInstanceOf(CombinationData::class, $combination->getData());
        $this->assertFalse($combination->getIsDataLoaded());
    }

    /**
     * Tests the cloning.
     * @covers ::__clone
     */
    public function testClone()
    {
        $item = new Item();
        $item->setType('foo')
             ->setName('bar');

        $combination = new Combination();
        $combination->setName('abc')
                    ->setMainModName('def')
                    ->setLoadedModNames(['ghi'])
                    ->setLoadedOptionalModNames(['jkl'])
                    ->setIsDataLoaded(true);
        $combination->getData()->addItem($item);

        $clonedCombination = clone($combination);
        $combination->setName('cba')
                    ->setMainModName('fed')
                    ->setLoadedModNames(['ihg'])
                    ->setLoadedOptionalModNames(['lkj'])
                    ->setIsDataLoaded(false);
        $combination->getData()->removeItem('foo', 'bar');

        $this->assertEquals('abc', $clonedCombination->getName());
        $this->assertEquals('def', $clonedCombination->getMainModName());
        $this->assertEquals(['ghi'], $clonedCombination->getLoadedModNames());
        $this->assertEquals(['jkl'], $clonedCombination->getLoadedOptionalModNames());
        $this->assertTrue($clonedCombination->getIsDataLoaded());
        $this->assertInstanceOf(Item::class, $clonedCombination->getData()->getItem('foo', 'bar'));
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName()
    {
        $combination = new Combination();
        $this->assertEquals($combination, $combination->setName('foo'));
        $this->assertEquals('foo', $combination->getName());
    }

    /**
     * Tests setting and getting the mainModName.
     * @covers ::setMainModName
     * @covers ::getMainModName
     */
    public function testSetAndGetMainModName()
    {
        $combination = new Combination();
        $this->assertEquals($combination, $combination->setMainModName('foo'));
        $this->assertEquals('foo', $combination->getMainModName());
    }

    /**
     * Tests setting, adding and getting the loaded mod names.
     * @covers ::setLoadedModNames
     * @covers ::getLoadedModNames
     * @covers ::addLoadedModName
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
     * @covers ::setLoadedOptionalModNames
     * @covers ::getLoadedOptionalModNames
     * @covers ::addLoadedOptionalModName
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
     * Tests setting and getting the data.
     * @covers ::setData
     * @covers ::getData
     */
    public function testSetAndGetData()
    {
        $data = new CombinationData();
        $data->addItem(new Item());
        
        $combination = new Combination();
        $this->assertEquals($combination, $combination->setData($data));
        $this->assertEquals($data, $combination->getData());
    }

    /**
     * Tests setting and getting the data loaded flag.
     * @covers ::setIsDataLoaded
     * @covers ::getIsDataLoaded
     */
    public function testSetAndGetIsDataLoaded()
    {
        $combination = new Combination();
        $this->assertEquals($combination, $combination->setIsDataLoaded(true));
        $this->assertEquals(true, $combination->getIsDataLoaded());
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
                    ->addLoadedOptionalModName('pqr');

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
     * @covers ::writeData
     * @covers ::readData
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
