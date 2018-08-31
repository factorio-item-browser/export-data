<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Registry;

use BluePsyduck\Common\Data\DataContainer;
use BluePsyduck\Common\Test\ReflectionTrait;
use FactorioItemBrowser\ExportData\Entity\EntityInterface;
use FactorioItemBrowser\ExportData\Entity\Icon;
use FactorioItemBrowser\ExportData\Entity\Item;
use FactorioItemBrowser\ExportData\Entity\Machine;
use FactorioItemBrowser\ExportData\Entity\Recipe;
use FactorioItemBrowser\ExportData\Registry\Adapter\AdapterInterface;
use FactorioItemBrowser\ExportData\Registry\EntityRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the EntityRegistry class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Registry\EntityRegistry
 */
class EntityRegistryTest extends TestCase
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
        $entityClassName = 'abc';
        $namespace = 'def';

        /* @var EntityRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(EntityRegistry::class)
                         ->setMethods(['getNamespace'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('getNamespace')
                 ->with($entityClassName)
                 ->willReturn($namespace);

        $registry->__construct($adapter, $entityClassName);
        $this->assertSame($adapter, $this->extractProperty($registry, 'adapter'));
        $this->assertSame($namespace, $this->extractProperty($registry, 'namespace'));
        $this->assertSame($entityClassName, $this->extractProperty($registry, 'entityClassName'));
    }

    /**
     * Provides the data for the getNamespace test.
     * @return array
     */
    public function provideGetNamespace(): array
    {
        return [
            [Icon::class, 'icon'],
            [Item::class, 'item'],
            [Machine::class, 'machine'],
            [Recipe::class, 'recipe'],
        ];
    }

    /**
     * Tests the getNamespace method.
     * @param string $entityClassName
     * @param string $expectedResult
     * @throws ReflectionException
     * @covers ::getNamespace
     * @dataProvider provideGetNamespace
     */
    public function testGetNamespace(string $entityClassName, string $expectedResult): void
    {
        /* @var EntityRegistry $registry */
        $registry = $this->createMock(EntityRegistry::class);

        $result = $this->invokeMethod($registry, 'getNamespace', $entityClassName);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the set method.
     * @covers ::set
     */
    public function testSet(): void
    {
        $entityData = ['abc' => 'def'];
        $encodedContent = 'ghi';
        $hash = 'jkl';

        /* @var EntityInterface|MockObject $entity */
        $entity = $this->getMockBuilder(EntityInterface::class)
                       ->setMethods(['calculateHash', 'writeData'])
                       ->getMockForAbstractClass();
        $entity->expects($this->once())
               ->method('calculateHash')
               ->willReturn($hash);
        $entity->expects($this->once())
               ->method('writeData')
               ->willReturn($entityData);


        /* @var EntityRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(EntityRegistry::class)
                         ->setMethods(['encodeContent', 'calculateHash', 'saveContent'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('encodeContent')
                 ->with($entityData)
                 ->willReturn($encodedContent);
        $registry->expects($this->once())
                 ->method('saveContent')
                 ->with($hash, $encodedContent);

        $result = $registry->set($entity);
        $this->assertSame($hash, $result);
    }

    /**
     * Provides the data for the get test.
     * @return array
     */
    public function provideGet(): array
    {
        /* @var EntityInterface $entity */
        $entity = $this->createMock(EntityInterface::class);

        return [
            ['abc', true, $entity, $entity],
            [null, false, null, null],
        ];
    }

    /**
     * Tests the get method.
     * @param string|null $content
     * @param bool $expectCreate
     * @param EntityInterface|null $resultCreate
     * @param EntityInterface|null $expectedResult
     * @covers ::get
     * @dataProvider provideGet
     */
    public function testGet(
        ?string $content,
        bool $expectCreate,
        ?EntityInterface $resultCreate,
        ?EntityInterface $expectedResult
    ): void {
        $hash = 'foo';

        /* @var EntityRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(EntityRegistry::class)
                         ->setMethods(['loadContent', 'createEntityFromContent'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('loadContent')
                 ->with($hash)
                 ->willReturn($content);
        $registry->expects($expectCreate ? $this->once() : $this->never())
                 ->method('createEntityFromContent')
                 ->with($content)
                 ->willReturn($resultCreate);

        $result = $registry->get($hash);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the remove method.
     * @covers ::remove
     */
    public function testRemove(): void
    {
        $hash = 'foo';

        /* @var EntityRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(EntityRegistry::class)
                         ->setMethods(['deleteContent'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('deleteContent')
                 ->with($hash);

        $registry->remove($hash);
    }

    /**
     * Tests the getAllHashes method.
     * @throws ReflectionException
     * @covers ::getAllHashes
     */
    public function testGetAllHashes(): void
    {
        $namespace = 'abc';
        $hashes = ['def', 'ghi'];

        /* @var AdapterInterface|MockObject $adapter */
        $adapter = $this->getMockBuilder(AdapterInterface::class)
                        ->setMethods(['getAllHashes'])
                        ->getMockForAbstractClass();
        $adapter->expects($this->once())
                ->method('getAllHashes')
                ->with($namespace)
                ->willReturn($hashes);

        /* @var EntityRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(EntityRegistry::class)
                         ->setMethods(['__construct'])
                         ->disableOriginalConstructor()
                         ->getMock();

        $this->injectProperty($registry, 'adapter', $adapter);
        $this->injectProperty($registry, 'namespace', $namespace);

        $result = $registry->getAllHashes();
        $this->assertSame($hashes, $result);
    }

    /**
     * Tests the createEntityFromContent method.
     * @throws ReflectionException
     * @covers ::createEntityFromContent
     */
    public function testCreateEntityFromContent(): void
    {
        $content = 'abc';
        $decodedContent = ['abc' => 'def'];
        $expectedData = new DataContainer($decodedContent);

        /* @var EntityInterface|MockObject $entity */
        $entity = $this->getMockBuilder(EntityInterface::class)
                       ->setMethods(['readData'])
                       ->getMockForAbstractClass();
        $entity->expects($this->once())
               ->method('readData')
               ->with($expectedData);

        /* @var EntityRegistry|MockObject $registry */
        $registry = $this->getMockBuilder(EntityRegistry::class)
                         ->setMethods(['createEntity', 'decodeContent'])
                         ->disableOriginalConstructor()
                         ->getMock();
        $registry->expects($this->once())
                 ->method('createEntity')
                 ->willReturn($entity);
        $registry->expects($this->once())
                 ->method('decodeContent')
                 ->with($content)
                 ->willReturn($decodedContent);

        $result = $this->invokeMethod($registry, 'createEntityFromContent', $content);
        $this->assertSame($entity, $result);
    }

    /**
     * Tests the createEntity method.
     * @throws ReflectionException
     * @covers ::createEntity
     */
    public function testCreateEntity(): void
    {
        $entityClassName = Item::class;
        /* @var AdapterInterface $adapter */
        $adapter = $this->createMock(AdapterInterface::class);

        $registry = new EntityRegistry($adapter, $entityClassName);
        $result = $this->invokeMethod($registry, 'createEntity');
        $this->assertInstanceOf($entityClassName, $result);
    }
}
