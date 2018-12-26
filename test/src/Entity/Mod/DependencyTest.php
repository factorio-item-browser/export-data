<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Entity\Mod;

use BluePsyduck\Common\Data\DataContainer;
use FactorioItemBrowser\ExportData\Entity\Mod\Dependency;
use FactorioItemBrowser\ExportData\Utils\EntityUtils;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the dependency class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 *
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Entity\Mod\Dependency
 */
class DependencyTest extends TestCase
{
    /**
     * Tests the constructing.
     * @coversNothing
     */
    public function testConstruct(): void
    {
        $dependency = new Dependency();
        $this->assertSame('', $dependency->getRequiredModName());
        $this->assertSame('', $dependency->getRequiredVersion());
        $this->assertFalse($dependency->getIsMandatory());
    }

    /**
     * Tests the cloning.
     * @coversNothing
     */
    public function testClone(): void
    {
        $dependency = new Dependency();
        $dependency->setRequiredModName('foo')
                   ->setRequiredVersion('4.2.0')
                   ->setIsMandatory(true);

        $clonedDependency = clone($dependency);
        $dependency->setRequiredModName('oof')
                   ->setRequiredVersion('0.2.4')
                   ->setIsMandatory(false);

        $this->assertSame('foo', $clonedDependency->getRequiredModName());
        $this->assertSame('4.2.0', $clonedDependency->getRequiredVersion());
        $this->assertTrue($clonedDependency->getIsMandatory());
    }

    /**
     * Tests setting and getting the required mod name.
     * @covers ::setRequiredModName
     * @covers ::getRequiredModName
     */
    public function testSetAndGetRequiredModName(): void
    {
        $dependency = new Dependency();
        $this->assertSame($dependency, $dependency->setRequiredModName('foo'));
        $this->assertSame('foo', $dependency->getRequiredModName());
    }

    /**
     * Tests setting and getting the required version.
     * @covers ::setRequiredVersion
     * @covers ::getRequiredVersion
     */
    public function testSetAndGetRequiredVersion(): void
    {
        $dependency = new Dependency();
        $this->assertSame($dependency, $dependency->setRequiredVersion('4.2.0'));
        $this->assertSame('4.2.0', $dependency->getRequiredVersion());
    }

    /**
     * Tests setting and getting the mandatory flag.
     * @covers ::setIsMandatory
     * @covers ::getIsMandatory
     */
    public function testSetAndGetIsMandatory(): void
    {
        $dependency = new Dependency();
        $this->assertSame($dependency, $dependency->setIsMandatory(true));
        $this->assertTrue($dependency->getIsMandatory());
    }

    /**
     * Provides the data for the writeAndReadData test.
     * @return array
     */
    public function provideTestWriteAndReadData(): array
    {
        $dependency = new Dependency();
        $dependency->setRequiredModName('abc')
                   ->setRequiredVersion('4.2.0')
                   ->setIsMandatory(true);

        $data = [
            'm' => 'abc',
            'v' => '4.2.0',
            'r' => 1
        ];

        return [
            [$dependency, $data],
            [new Dependency(), []]
        ];
    }

    /**
     * Tests the writing and reading of the data.
     * @param Dependency $dependency
     * @param array $expectedData
     * @covers ::writeData
     * @covers ::readData
     * @dataProvider provideTestWriteAndReadData
     */
    public function testWriteAndReadData(Dependency $dependency, array $expectedData): void
    {
        $data = $dependency->writeData();
        $this->assertEquals($expectedData, $data);

        $newDependency = new Dependency();
        $this->assertSame($newDependency, $newDependency->readData(new DataContainer($data)));
        $this->assertEquals($newDependency, $dependency);
    }

    /**
     * Tests the calculateHash method.
     * @covers ::calculateHash
     */
    public function testCalculateHash(): void
    {
        $dependency = new Dependency();
        $dependency->setRequiredModName('abc')
                   ->setRequiredVersion('4.2.0')
                   ->setIsMandatory(true);

        $expectedResult = EntityUtils::calculateHashOfArray([
            'abc',
            '4.2.0',
            true,
        ]);

        $result = $dependency->calculateHash();
        $this->assertSame($expectedResult, $result);
    }
}
