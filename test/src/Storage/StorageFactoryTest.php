<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Storage;

use BluePsyduck\TestHelper\ReflectionTrait;
use FactorioItemBrowser\ExportData\Storage\StorageFactory;
use FactorioItemBrowser\ExportData\Storage\ZipArchiveStorage;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the StorageFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Storage\StorageFactory
 */
class StorageFactoryTest extends TestCase
{
    use ReflectionTrait;

    /**
     * The mocked serializer.
     * @var SerializerInterface&MockObject
     */
    protected $serializer;

    /**
     * Sets up the test case.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->serializer = $this->createMock(SerializerInterface::class);
    }

    /**
     * Tests the constructing.
     * @throws ReflectionException
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $workingDirectory = 'abc';

        $factory = new StorageFactory($this->serializer, $workingDirectory);

        $this->assertSame($this->serializer, $this->extractProperty($factory, 'serializer'));
        $this->assertSame($workingDirectory, $this->extractProperty($factory, 'workingDirectory'));
    }

    /**
     * Tests the createForCombination method.
     * @throws ReflectionException
     * @covers ::createForCombination
     */
    public function testCreateForCombination(): void
    {
        $workingDirectory = 'abc';
        $combinationId = 'def';
        $expectedFileName = 'abc/def.zip';

        $factory = new StorageFactory($this->serializer, $workingDirectory);
        $storage = $factory->createForCombination($combinationId);

        $this->assertInstanceOf(ZipArchiveStorage::class, $storage);
        $this->assertSame($this->serializer, $this->extractProperty($storage, 'serializer'));
        $this->assertSame($expectedFileName, $this->extractProperty($storage, 'fileName'));
    }
}
