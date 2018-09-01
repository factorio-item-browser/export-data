<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Registry;

use BluePsyduck\Common\Test\ReflectionTrait;
use FactorioItemBrowser\ExportData\Entity\Mod;
use FactorioItemBrowser\ExportData\Registry\Adapter\AdapterInterface;
use FactorioItemBrowser\ExportData\Registry\ModRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the ModRegistry class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Registry\ModRegistry
 */
class ModRegistryTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests the constructing.
     * @throws ReflectionException
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        /* @var AdapterInterface $adapter */
        $adapter = $this->createMock(AdapterInterface::class);

        $registry = new ModRegistry($adapter);
        $this->assertSame($adapter, $this->extractProperty($registry, 'adapter'));
        $this->assertSame('mod', $this->extractProperty($registry, 'namespace'));
        $this->assertSame([], $this->extractProperty($registry, 'mods'));
        $this->assertFalse($this->extractProperty($registry, 'isLoaded'));
    }

    /**
     * Tests the set method.
     * @throws ReflectionException
     * @covers ::set
     */
    public function testSet(): void
    {
        $mod1 = new Mod();
        $mod1->setName('abc');
        $mod2 = new Mod();
        $mod2->setName('def');

        $mods = ['abc' => $mod1];
        $expectedMods = ['abc' => $mod1, 'def' => $mod2];

        /* @var ModRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(ModRegistry::class)
                         ->setMethods(['loadMods'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('loadMods');
        $this->injectProperty($registry, 'mods', $mods);

        $registry->set($mod2);
        $this->assertEquals($expectedMods, $this->extractProperty($registry, 'mods'));
    }

    /**
     * Provides the data for the get test.
     * @return array
     */
    public function provideGet(): array
    {
        $mod1 = new Mod();
        $mod1->setName('abc');
        $mod2 = new Mod();
        $mod2->setName('def');
        $mods = ['abc' => $mod1, 'def' => $mod2];

        return [
            [$mods, 'abc', $mod1],
            [$mods, 'ghi', null],
        ];
    }

    /**
     * Tests the get method.
     * @param array|Mod[] $mods
     * @param Mod|null $expectedResult
     * @throws ReflectionException
     * @covers ::get
     * @dataProvider provideGet
     */
    public function testGet(array $mods, string $modName, ?Mod $expectedResult): void
    {
        /* @var ModRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(ModRegistry::class)
                         ->setMethods(['loadMods'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('loadMods');
        $this->injectProperty($registry, 'mods', $mods);

        $result = $registry->get($modName);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the remove method.
     * @throws ReflectionException
     * @covers ::remove
     */
    public function testRemove(): void
    {
        $mod1 = new Mod();
        $mod1->setName('abc');
        $mod2 = new Mod();
        $mod2->setName('def');

        $hash = 'abc';
        $mods = ['abc' => $mod1, 'def' => $mod2];
        $expectedMods = ['def' => $mod2];

        /* @var ModRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(ModRegistry::class)
                         ->setMethods(['loadMods'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('loadMods');
        $this->injectProperty($registry, 'mods', $mods);

        $registry->remove($hash);
        $this->assertEquals($expectedMods, $this->extractProperty($registry, 'mods'));
    }

    /**
     * Tests the saveMods method.
     * @throws ReflectionException
     * @covers ::saveMods
     */
    public function testSaveMods(): void
    {
        $mod1 = new Mod();
        $mod1->setName('abc');
        $mod2 = new Mod();
        $mod2->setName('def');
        $mods = ['abc' => $mod1, 'def' => $mod2];
        $expectedMods = [['n' => 'abc'], ['n' => 'def']];
        $encodedContent = 'ghi';

        /* @var ModRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(ModRegistry::class)
            ->setMethods(['encodeContent', 'saveContent'])
            ->disableOriginalConstructor()
            ->getMock();
        $registry->expects($this->once())
            ->method('encodeContent')
            ->with($expectedMods)
            ->willReturn($encodedContent);
        $registry->expects($this->once())
            ->method('saveContent')
            ->with('0000000000000000', $encodedContent);
        $this->injectProperty($registry, 'mods', $mods);

        $this->invokeMethod($registry, 'saveMods');
    }

    /**
     * Provides the data for the loadMods test.
     * @return array
     */
    public function provideLoadMods(): array
    {
        $mod1 = new Mod();
        $mod1->setName('abc');
        $mod2 = new Mod();
        $mod2->setName('def');
        $mod3 = new Mod();
        $mod3->setName('ghi');

        return [
            [
                false,
                ['abc' => $mod1],
                true,
                'foo',
                [['n' => 'def'], ['n' => 'ghi']],
                ['def' => $mod2, 'ghi' => $mod3],
            ],
            [
                true,
                ['abc' => $mod1],
                false,
                '',
                [],
                ['abc' => $mod1],
            ],
        ];
    }


    /**
     * Tests the loadMods method.
     * @param bool $isLoaded
     * @param array $mods
     * @param bool $expectLoad
     * @param string $resultLoadContent
     * @param array $decodedContent
     * @param array $expectedMods
     * @throws ReflectionException
     * @covers ::loadMods
     * @dataProvider provideLoadMods
     */
    public function testLoadMods(
        bool $isLoaded,
        array $mods,
        bool $expectLoad,
        string $resultLoadContent,
        array $decodedContent,
        array $expectedMods
    ): void {
        /* @var ModRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(ModRegistry::class)
                         ->setMethods(['loadContent', 'decodeContent'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($expectLoad ? $this->once() : $this->never())
                 ->method('loadContent')
                 ->with('0000000000000000')
                 ->willReturn($resultLoadContent);
        $registry->expects($expectLoad ? $this->once() : $this->never())
                 ->method('decodeContent')
                 ->with($resultLoadContent)
                 ->willReturn($decodedContent);
        $this->injectProperty($registry, 'isLoaded', $isLoaded);
        $this->injectProperty($registry, 'mods', $mods);

        $this->invokeMethod($registry, 'loadMods');
        $this->assertTrue($this->extractProperty($registry, 'isLoaded'));
        $this->assertEquals($expectedMods, $this->extractProperty($registry, 'mods'));
    }

    /**
     * Tests the getAllNames method.
     * @throws ReflectionException
     * @covers ::getAllNames
     */
    public function testGetAllNames(): void
    {
        $mods = ['abc' => 'def', 'ghi' => 'jkl'];
        $expectedResult = ['abc', 'ghi'];

        /* @var ModRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(ModRegistry::class)
                         ->setMethods(['loadMods'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('loadMods');
        $this->injectProperty($registry, 'mods', $mods);

        $result = $registry->getAllNames();
        $this->assertSame($expectedResult, $result);
    }
}
