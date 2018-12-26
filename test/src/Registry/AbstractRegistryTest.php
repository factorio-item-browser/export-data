<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Registry;

use BluePsyduck\Common\Test\ReflectionTrait;
use FactorioItemBrowser\ExportData\Registry\AbstractRegistry;
use FactorioItemBrowser\ExportData\Registry\Adapter\AdapterInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the AbstractRegistry class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Registry\AbstractRegistry
 */
class AbstractRegistryTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests the constructing.
     * @covers ::__construct
     * @throws ReflectionException
     */
    public function testConstruct(): void
    {
        /* @var AdapterInterface $adapter */
        $adapter = $this->createMock(AdapterInterface::class);
        $namespace = 'abc';

        /* @var AbstractRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(AbstractRegistry::class)
                         ->setConstructorArgs([$adapter, $namespace])
                         ->getMockForAbstractClass();

        $this->assertSame($adapter, $this->extractProperty($registry, 'adapter'));
        $this->assertSame($namespace, $this->extractProperty($registry, 'namespace'));
    }

    /**
     * Tests the saveContent method.
     * @covers ::saveContent
     * @throws ReflectionException
     */
    public function testSaveContent(): void
    {
        $cache = ['abc' => 'def'];
        $hash = 'ghi';
        $content = 'jkl';
        $expectedCache = ['abc' => 'def', 'ghi' => 'jkl'];
        $namespace = 'mno';

        /* @var AdapterInterface|MockObject $adapter */
        $adapter = $this->getMockBuilder(AdapterInterface::class)
                        ->setMethods(['save'])
                        ->getMockForAbstractClass();
        $adapter->expects($this->once())
                ->method('save')
                ->with($namespace, $hash, $content);

        /* @var AbstractRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(AbstractRegistry::class)
                         ->setConstructorArgs([$adapter, $namespace])
                         ->getMockForAbstractClass();
        $this->injectProperty($registry, 'cache', $cache);

        $this->invokeMethod($registry, 'saveContent', $hash, $content);
        $this->assertEquals($expectedCache, $this->extractProperty($registry, 'cache'));
    }

    /**
     * Provides the data for the loadContent test.
     * @return array
     */
    public function provideLoadContent(): array
    {
        return [
            [
                ['abc' => 'def'],
                'abc',
                false,
                null,
                'def',
                ['abc' => 'def'],
            ],
            [
                ['abc' => null],
                'abc',
                false,
                null,
                null,
                ['abc' => null],
            ],
            [
                ['abc' => 'def'],
                'ghi',
                true,
                'jkl',
                'jkl',
                ['abc' => 'def', 'ghi' => 'jkl']
            ],
            [
                ['abc' => 'def'],
                'ghi',
                true,
                null,
                null,
                ['abc' => 'def', 'ghi' => null]
            ],
        ];
    }

    /**
     * Tests the loadContent method.
     * @param array $cache
     * @param string $hash
     * @param bool $expectLoad
     * @param null|string $resultLoad
     * @param null|string $expectedResult
     * @param array $expectedCache
     * @throws ReflectionException
     * @covers ::loadContent
     * @dataProvider provideLoadContent
     */
    public function testLoadContent(
        array $cache,
        string $hash,
        bool $expectLoad,
        ?string $resultLoad,
        ?string $expectedResult,
        array $expectedCache
    ): void {
        $namespace = 'abc';

        /* @var AdapterInterface|MockObject $adapter */
        $adapter = $this->getMockBuilder(AdapterInterface::class)
                        ->setMethods(['load'])
                        ->getMockForAbstractClass();
        $adapter->expects($expectLoad ? $this->once() : $this->never())
                ->method('load')
                ->with($namespace, $hash)
                ->willReturn($resultLoad);

        /* @var AbstractRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(AbstractRegistry::class)
                         ->setConstructorArgs([$adapter, $namespace])
                         ->getMockForAbstractClass();
        $this->injectProperty($registry, 'cache', $cache);

        $result = $this->invokeMethod($registry, 'loadContent', $hash);
        $this->assertSame($expectedResult, $result);
        $this->assertSame($expectedCache, $this->extractProperty($registry, 'cache'));
    }

    /**
     * Tests the deleteContent method.
     * @throws ReflectionException
     * @covers ::deleteContent
     */
    public function testDeleteContent(): void
    {
        $cache = [
            'abc' => 'def',
            'ghi' => 'jkl',
        ];
        $expectedCache = [
            'abc' => 'def',
        ];
        $namespace = 'mno';
        $hash = 'ghi';

        /* @var AdapterInterface|MockObject $adapter */
        $adapter = $this->getMockBuilder(AdapterInterface::class)
                        ->setMethods(['delete'])
                        ->getMockForAbstractClass();
        $adapter->expects($this->once())
                ->method('delete')
                ->with($namespace, $hash);

        /* @var AbstractRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(AbstractRegistry::class)
                         ->setConstructorArgs([$adapter, $namespace])
                         ->getMockForAbstractClass();
        $this->injectProperty($registry, 'cache', $cache);

        $this->invokeMethod($registry, 'deleteContent', $hash);
        $this->assertSame($expectedCache, $this->extractProperty($registry, 'cache'));
    }

    /**
     * Tests the encodeContent method.
     * @covers ::encodeContent
     * @throws ReflectionException
     */
    public function testEncodeContent(): void
    {
        $content = [
            'abc' => 'def',
            'ghi' => 'jk/l',
            'mno' => '何か'
        ];
        $expectedResult = '{"abc":"def","ghi":"jk/l","mno":"何か"}';

        /* @var AbstractRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(AbstractRegistry::class)
                         ->disableOriginalConstructor()
                         ->getMockForAbstractClass();

        $result = $this->invokeMethod($registry, 'encodeContent', $content);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Provides the data for the decodeContent test.
     * @return array
     */
    public function provideDecodeContent(): array
    {
        return [
            [
                '{"abc":"def","ghi":"jk/l","mno":"何か"}',
                ['abc' => 'def', 'ghi' => 'jk/l', 'mno' => '何か'],
            ],
            [
                '42',
                []
            ]
        ];
    }

    /**
     * Tests the decodeContent method.
     * @param string $content
     * @param array $expectedResult
     * @throws ReflectionException
     * @covers ::decodeContent
     * @dataProvider provideDecodeContent
     */
    public function testDecodeContent(string $content, array $expectedResult): void
    {
        /* @var AbstractRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(AbstractRegistry::class)
                         ->disableOriginalConstructor()
                         ->getMockForAbstractClass();

        $result = $this->invokeMethod($registry, 'decodeContent', $content);
        $this->assertSame($expectedResult, $result);
    }
}
