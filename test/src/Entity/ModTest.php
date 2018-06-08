<?php

namespace FactorioItemBrowserTest\ExportData\Entity;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\LocalisedString;
use FactorioItemBrowser\ExportData\Entity\Mod;
use FactorioItemBrowser\ExportData\Entity\Mod\Combination;
use FactorioItemBrowser\ExportData\Entity\Mod\Dependency;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the mod class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Mod
 */
class ModTest extends TestCase
{
    /**
     * Tests the constructing.
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $mod = new Mod();
        $this->assertEquals('', $mod->getName());
        $this->assertInstanceOf(LocalisedString::class, $mod->getTitles());
        $this->assertInstanceOf(LocalisedString::class, $mod->getDescriptions());
        $this->assertEquals('', $mod->getAuthor());
        $this->assertEquals('', $mod->getVersion());
        $this->assertEquals('', $mod->getFileName());
        $this->assertEquals('', $mod->getDirectoryName());
        $this->assertEquals([], $mod->getDependencies());
        $this->assertEquals('', $mod->getChecksum());
        $this->assertEquals(0, $mod->getOrder());
        $this->assertEquals([], $mod->getCombinations());
    }

    /**
     * Tests the cloning.
     * @covers ::__clone
     */
    public function testClone()
    {
        $dependency = new Dependency();
        $dependency->setRequiredModName('foo');
        $combination = new Combination();
        $combination->setName('bar');

        $mod = new Mod();
        $mod->setName('abc')
            ->setAuthor('def')
            ->setVersion('4.2.0')
            ->setFileName('ghi')
            ->setDirectoryName('jkl')
            ->addDependency($dependency)
            ->setChecksum('mno')
            ->setOrder(42)
            ->addCombination($combination);
        $mod->getTitles()->setTranslation('en', 'pqr');
        $mod->getDescriptions()->setTranslation('en', 'stu');

        $clonedMod = clone($mod);
        $mod->setName('cba')
            ->setAuthor('fed')
            ->setVersion('0.2.4')
            ->setFileName('ihg')
            ->setDirectoryName('lkj')
            ->setChecksum('onm')
            ->setOrder(24);
        $mod->getTitles()->setTranslation('en', 'rqp');
        $mod->getDescriptions()->setTranslation('en', 'uts');
        $dependency->setRequiredModName('oof');
        $combination->setName('rab');

        $this->assertEquals('abc', $clonedMod->getName());
        $this->assertEquals('def', $clonedMod->getAuthor());
        $this->assertEquals('4.2.0', $clonedMod->getVersion());
        $this->assertEquals('ghi', $clonedMod->getFileName());
        $this->assertEquals('jkl', $clonedMod->getDirectoryName());
        $this->assertEquals('mno', $clonedMod->getChecksum());
        $this->assertEquals(42, $clonedMod->getOrder());
        $this->assertEquals('pqr', $clonedMod->getTitles()->getTranslation('en'));
        $this->assertEquals('stu', $clonedMod->getDescriptions()->getTranslation('en'));
        $dependencies = $clonedMod->getDependencies();
        $this->assertEquals('foo', array_pop($dependencies)->getRequiredModName());
        $combinations = $clonedMod->getCombinations();
        $this->assertEquals('bar', array_pop($combinations)->getName());
    }

    /**
     * Tests setting and getting the name.
     * @covers ::setName
     * @covers ::getName
     */
    public function testSetAndGetName()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setName('foo'));
        $this->assertEquals('foo', $mod->getName());
    }

    /**
     * Tests setting and getting the titles.
     * @covers ::setTitles
     * @covers ::getTitles
     */
    public function testSetAndGetTitles()
    {
        $titles = new LocalisedString();
        $titles->setTranslation('en', 'foo');
        
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setTitles($titles));
        $this->assertEquals($titles, $mod->getTitles());
    }

    /**
     * Tests setting and getting the descriptions.
     * @covers ::setDescriptions
     * @covers ::getDescriptions
     */
    public function testSetAndGetDescriptions()
    {
        $descriptions = new LocalisedString();
        $descriptions->setTranslation('en', 'foo');

        $mod = new Mod();
        $this->assertEquals($mod, $mod->setDescriptions($descriptions));
        $this->assertEquals($descriptions, $mod->getDescriptions());
    }

    /**
     * Tests setting and getting the author.
     * @covers ::setAuthor
     * @covers ::getAuthor
     */
    public function testSetAndGetAuthor()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setAuthor('foo'));
        $this->assertEquals('foo', $mod->getAuthor());
    }

    /**
     * Tests setting and getting the version.
     * @covers ::setVersion
     * @covers ::getVersion
     */
    public function testSetAndGetVersion()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setVersion('4.2.0'));
        $this->assertEquals('4.2.0', $mod->getVersion());
    }

    /**
     * Tests setting and getting the fileName.
     * @covers ::setFileName
     * @covers ::getFileName
     */
    public function testSetAndGetFileName()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setFileName('foo'));
        $this->assertEquals('foo', $mod->getFileName());
    }

    /**
     * Tests setting and getting the directoryName.
     * @covers ::setDirectoryName
     * @covers ::getDirectoryName
     */
    public function testSetAndGetDirectoryName()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setDirectoryName('foo'));
        $this->assertEquals('foo', $mod->getDirectoryName());
    }

    /**
     * Tests setting, adding and getting the dependencies.
     * @covers ::setDependencies
     * @covers ::getDependencies
     * @covers ::addDependency
     */
    public function testSetAddAndGetDependencies()
    {
        $dependency1 = new Dependency();
        $dependency1->setRequiredModName('abc');
        $dependency2 = new Dependency();
        $dependency2->setRequiredModName('def');
        $dependency3 = new Dependency();
        $dependency3->setRequiredModName('ghi');

        $mod = new Mod();
        $this->assertEquals($mod, $mod->setDependencies([$dependency1, new Mod(), $dependency2]));
        $this->assertEquals([$dependency1, $dependency2], $mod->getDependencies());

        $this->assertEquals($mod, $mod->addDependency($dependency3));
        $this->assertEquals([$dependency1, $dependency2, $dependency3], $mod->getDependencies());
    }

    /**
     * Tests setting and getting the checksum.
     * @covers ::setChecksum
     * @covers ::getChecksum
     */
    public function testSetAndGetChecksum()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setChecksum('foo'));
        $this->assertEquals('foo', $mod->getChecksum());
    }

    /**
     * Tests setting and getting the order.
     * @covers ::setOrder
     * @covers ::getOrder
     */
    public function testSetAndGetOrder()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setOrder(42));
        $this->assertEquals(42, $mod->getOrder());
    }

    /**
     * Tests setting, adding and getting the combinations.
     * @covers ::setCombinations
     * @covers ::getCombinations
     * @covers ::addCombination
     */
    public function testSetAddAndGetCombinations()
    {
        $combination1 = new Combination();
        $combination1->setName('abc');
        $combination2 = new Combination();
        $combination2->setName('def');
        $combination3 = new Combination();
        $combination3->setName('ghi');

        $mod = new Mod();
        $this->assertEquals($mod, $mod->setCombinations([$combination1, new Mod(), $combination2]));
        $this->assertEquals([$combination1, $combination2], $mod->getCombinations());

        $this->assertEquals($mod, $mod->addCombination($combination3));
        $this->assertEquals([$combination1, $combination2, $combination3], $mod->getCombinations());
    }

    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $dependency1 = new Dependency();
        $dependency1->setRequiredModName('foo');
        $dependency2 = new Dependency();
        $dependency2->setRequiredModName('bar');
        $combination1 = new Combination();
        $combination1->setName('oof');
        $combination2 = new Combination();
        $combination2->setName('rab');


        $mod = new Mod();
        $mod->setName('abc')
            ->setAuthor('def')
            ->setVersion('4.2.0')
            ->setFileName('ghi')
            ->setDirectoryName('jkl')
            ->addDependency($dependency1)
            ->addDependency($dependency2)
            ->setChecksum('mno')
            ->addCombination($combination1)
            ->addCombination($combination2);
        $mod->getTitles()->setTranslation('en', 'pqr');
        $mod->getDescriptions()->setTranslation('de', 'stu');

        $data = [
            'n' => 'abc',
            't' => [
                'en' => 'pqr'
            ],
            'd' => [
                'de' => 'stu'
            ],
            'a' => 'def',
            'v' => '4.2.0',
            'f' => 'ghi',
            'i' => 'jkl',
            'e' => [
                ['m' => 'foo'],
                ['m' => 'bar']
            ],
            'c' => 'mno',
            'm' => [
                ['n' => 'oof'],
                ['n' => 'rab']
            ]
        ];

        return [
            [$mod, $data],
            [new Mod(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param Mod $mod
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Mod $mod, array $expectedData)
    {
        $data = $mod->writeData();
        $this->assertEquals($expectedData, $data);

        $newMod = new Mod();
        $this->assertEquals($newMod, $newMod->readData(new DataContainer($data)));
        $this->assertEquals($newMod, $mod);
    }
}
