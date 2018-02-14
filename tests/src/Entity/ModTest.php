<?php

namespace FactorioItemBrowserTest\ExportData\Entity;

use FactorioItemBrowser\ExportData\Entity\LocalisedString;
use FactorioItemBrowser\ExportData\Entity\Mod;
use FactorioItemBrowser\ExportData\Entity\Mod\Dependency;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the mod class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass FactorioItemBrowser\ExportData\Entity\Mod
 */
class ModTest extends TestCase
{
    /**
     * Tests the constructing.
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
        $this->assertEquals([], $mod->getCombinationNames());
    }

    /**
     * Tests the cloning.
     */
    public function testClone()
    {
        $dependency = new Dependency();
        $dependency->setRequiredModName('foo');

        $mod = new Mod();
        $mod->setName('abc')
            ->setAuthor('def')
            ->setVersion('4.2.0')
            ->setFileName('ghi')
            ->setDirectoryName('jkl')
            ->addDependency($dependency)
            ->setChecksum('mno')
            ->setOrder(42)
            ->setCombinationNames(['pqr']);
        $mod->getTitles()->setTranslation('en', 'stu');
        $mod->getDescriptions()->setTranslation('en', 'vwx');

        $clonedMod = clone($mod);
        $mod->setName('cba')
            ->setAuthor('fed')
            ->setVersion('0.2.4')
            ->setFileName('ihg')
            ->setDirectoryName('lkj')
            ->setChecksum('onm')
            ->setOrder(24)
            ->setCombinationNames(['rqp']);
        $mod->getTitles()->setTranslation('en', 'uts');
        $mod->getDescriptions()->setTranslation('en', 'xwv');
        $dependency->setRequiredModName('oof');

        $this->assertEquals('abc', $clonedMod->getName());
        $this->assertEquals('def', $clonedMod->getAuthor());
        $this->assertEquals('4.2.0', $clonedMod->getVersion());
        $this->assertEquals('ghi', $clonedMod->getFileName());
        $this->assertEquals('jkl', $clonedMod->getDirectoryName());
        $this->assertEquals('mno', $clonedMod->getChecksum());
        $this->assertEquals(42, $clonedMod->getOrder());
        $this->assertEquals(['pqr'], $clonedMod->getCombinationNames());
        $this->assertEquals('stu', $clonedMod->getTitles()->getTranslation('en'));
        $this->assertEquals('vwx', $clonedMod->getDescriptions()->getTranslation('en'));
        $dependencies = $clonedMod->getDependencies();
        $this->assertEquals('foo', array_pop($dependencies)->getRequiredModName());
    }

    /**
     * Tests setting and getting the name.
     */
    public function testSetAndGetName()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setName('foo'));
        $this->assertEquals('foo', $mod->getName());
    }

    /**
     * Tests setting and getting the titles.
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
     */
    public function testSetAndGetAuthor()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setAuthor('foo'));
        $this->assertEquals('foo', $mod->getAuthor());
    }

    /**
     * Tests setting and getting the version.
     */
    public function testSetAndGetVersion()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setVersion('4.2.0'));
        $this->assertEquals('4.2.0', $mod->getVersion());
    }

    /**
     * Tests setting and getting the fileName.
     */
    public function testSetAndGetFileName()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setFileName('foo'));
        $this->assertEquals('foo', $mod->getFileName());
    }

    /**
     * Tests setting and getting the directoryName.
     */
    public function testSetAndGetDirectoryName()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setDirectoryName('foo'));
        $this->assertEquals('foo', $mod->getDirectoryName());
    }

    /**
     * Tests setting, adding and getting the dependencies.
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
     */
    public function testSetAndGetChecksum()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setChecksum('foo'));
        $this->assertEquals('foo', $mod->getChecksum());
    }

    /**
     * Tests setting and getting the order.
     */
    public function testSetAndGetOrder()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setOrder(42));
        $this->assertEquals(42, $mod->getOrder());
    }

    /**
     * Tests setting, adding and getting the combination names.
     */
    public function testSetAddAndGetCombinationNames()
    {
        $mod = new Mod();
        $this->assertEquals($mod, $mod->setCombinationNames(['abc', 'def']));
        $this->assertEquals(['abc', 'def'], $mod->getCombinationNames());

        $this->assertEquals($mod, $mod->addCombinationName('ghi'));
        $this->assertEquals(['abc', 'def', 'ghi'], $mod->getCombinationNames());
    }
}
