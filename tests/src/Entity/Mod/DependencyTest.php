<?php

namespace FactorioItemBrowserTest\ExportData\Entity\Mod;

use FactorioItemBrowser\ExportData\Entity\Mod\Dependency;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the dependency class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass FactorioItemBrowser\ExportData\Entity\Mod\Dependency
 */
class DependencyTest extends TestCase
{
    /**
     * Tests the constructing.
     */
    public function testConstruct()
    {
        $dependency = new Dependency();
        $this->assertEquals('', $dependency->getRequiredModName());
        $this->assertEquals('', $dependency->getRequiredVersion());
        $this->assertEquals(false, $dependency->getIsMandatory());
    }

    /**
     * Tests the cloning.
     */
    public function testClone()
    {
        $dependency = new Dependency();
        $dependency->setRequiredModName('foo')
                   ->setRequiredVersion('4.2.0')
                   ->setIsMandatory(true);

        $clonedDependency = clone($dependency);
        $dependency->setRequiredModName('oof')
                   ->setRequiredVersion('0.2.4')
                   ->setIsMandatory(false);

        $this->assertEquals('foo', $clonedDependency->getRequiredModName());
        $this->assertEquals('4.2.0', $clonedDependency->getRequiredVersion());
        $this->assertEquals(true, $clonedDependency->getIsMandatory());
    }

    /**
     * Tests setting and getting the required mod name.
     */
    public function testSetAndGetRequiredModName()
    {
        $dependency = new Dependency();
        $this->assertEquals($dependency, $dependency->setRequiredModName('foo'));
        $this->assertEquals('foo', $dependency->getRequiredModName());
    }

    /**
     * Tests setting and getting the required version.
     */
    public function testSetAndGetRequiredVersion()
    {
        $dependency = new Dependency();
        $this->assertEquals($dependency, $dependency->setRequiredVersion('4.2.0'));
        $this->assertEquals('4.2.0', $dependency->getRequiredVersion());
    }

    /**
     * Tests setting and getting the mandatory flag.
     */
    public function testSetAndGetIsMandatory()
    {
        $dependency = new Dependency();
        $this->assertEquals($dependency, $dependency->setIsMandatory(true));
        $this->assertEquals(true, $dependency->getIsMandatory());
    }
}
