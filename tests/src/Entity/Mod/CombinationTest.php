<?php

namespace FactorioItemBrowserTest\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Mod\Combination;
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
    }

    /**
     * Tests the cloning.
     */
    public function testClone()
    {
        $combination = new Combination();
        $combination->setName('abc')
                    ->setMainModName('def')
                    ->setLoadedModNames(['ghi'])
                    ->setLoadedOptionalModNames(['jkl']);

        $clonedCombination = clone($combination);
        $combination->setName('cba')
                    ->setMainModName('fed')
                    ->setLoadedModNames(['ihg'])
                    ->setLoadedOptionalModNames(['lkj']);

        $this->assertEquals('abc', $clonedCombination->getName());
        $this->assertEquals('def', $clonedCombination->getMainModName());
        $this->assertEquals(['ghi'], $clonedCombination->getLoadedModNames());
        $this->assertEquals(['jkl'], $clonedCombination->getLoadedOptionalModNames());
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
