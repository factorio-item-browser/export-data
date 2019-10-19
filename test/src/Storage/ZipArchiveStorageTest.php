<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Storage;

use BluePsyduck\TestHelper\ReflectionTrait;
use Exception;
use FactorioItemBrowser\ExportData\Entity\Combination;
use FactorioItemBrowser\ExportData\Storage\ZipArchiveStorage;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use ZipArchive;

/**
 * The PHPUnit test of the ZipArchiveStorage class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Storage\ZipArchiveStorage
 */
class ZipArchiveStorageTest extends TestCase
{
    use ReflectionTrait;

    /**
     * The mocked serializer.
     * @var SerializerInterface&MockObject
     */
    protected $serializer;

    /**
     * The mocked zip archive.
     * @var ZipArchive&MockObject
     */
    protected $zipArchive;

    /**
     * Sets up the test case.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->zipArchive = $this->createMock(ZipArchive::class);
    }

    /**
     * Creates a mocked storage instance without actual constructor and destructor.
     * @param array $mockedMethods
     * @return ZipArchiveStorage&MockObject
     */
    protected function createMockedStorage(array $mockedMethods = []): ZipArchiveStorage
    {
        $fileName = 'abc';

        /* @var ZipArchiveStorage&MockObject $storage */
        $storage = $this->getMockBuilder(ZipArchiveStorage::class)
                        ->setMethods(array_merge($mockedMethods, ['createZipArchive', '__destruct']))
                        ->disableOriginalConstructor()
                        ->getMock();
        $storage->expects($this->once())
                ->method('createZipArchive')
                ->with($this->identicalTo($fileName))
                ->willReturn($this->zipArchive);

        $storage->__construct($this->serializer, $fileName);
        return $storage;
    }

    /**
     * Tests the constructing.
     * @throws ReflectionException
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $storage = $this->createMockedStorage();

        $this->assertSame($this->serializer, $this->extractProperty($storage, 'serializer'));
        $this->assertSame($this->zipArchive, $this->extractProperty($storage, 'zipArchive'));
    }

    /**
     * Tests the destructor.
     * @covers ::__destruct
     */
    public function testDestruct(): void
    {
        $fileName = 'abc';

        /* @var ZipArchiveStorage&MockObject $storage */
        $storage = $this->getMockBuilder(ZipArchiveStorage::class)
                        ->setMethods(['createZipArchive'])
                        ->disableOriginalConstructor()
                        ->getMock();
        $storage->expects($this->once())
                ->method('createZipArchive')
                ->with($this->identicalTo($fileName))
                ->willReturn($this->zipArchive);

        $storage->__construct($this->serializer, $fileName);

        $this->zipArchive->expects($this->once())
                         ->method('close');

        $storage->__destruct();
    }

    /**
     * Tests the createZipArchive method.
     * @throws ReflectionException
     * @covers ::createZipArchive
     */
    public function testCreateZipArchive(): void
    {
        $fileName = realpath(__DIR__ . '/../../asset') . '/temp.zip';

        /* @var ZipArchiveStorage&MockObject $storage */
        $storage = $this->getMockBuilder(ZipArchiveStorage::class)
                        ->setMethods(['__destruct'])
                        ->disableOriginalConstructor()
                        ->getMock();

        /* @var ZipArchive $result */
        $result = $this->invokeMethod($storage, 'createZipArchive', $fileName);

        $this->assertSame($fileName, $result->filename);
    }

    /**
     * Tests the addRenderedIcon method.
     * @covers ::addRenderedIcon
     */
    public function testAddRenderedIcon(): void
    {
        $iconId = 'abc';
        $iconFileName = 'def';
        $contents = 'ghi';

        $this->zipArchive->expects($this->once())
                         ->method('addFromString')
                         ->with($this->identicalTo($iconFileName), $this->identicalTo($contents));

        $storage = $this->createMockedStorage(['getRenderedIconFileName']);
        $storage->expects($this->once())
                ->method('getRenderedIconFileName')
                ->with($this->identicalTo($iconId))
                ->willReturn($iconFileName);

        $storage->addRenderedIcon($iconId, $contents);
    }

    /**
     * Tests the getRenderedIcon method.
     * @covers ::getRenderedIcon
     */
    public function testGetRenderedIcon(): void
    {
        $iconId = 'abc';
        $iconFileName = 'def';
        $contents = 'ghi';

        $this->zipArchive->expects($this->once())
                         ->method('getFromName')
                         ->with($this->identicalTo($iconFileName))
                         ->willReturn($contents);

        $storage = $this->createMockedStorage(['getRenderedIconFileName']);
        $storage->expects($this->once())
                ->method('getRenderedIconFileName')
                ->with($this->identicalTo($iconId))
                ->willReturn($iconFileName);

        $result = $storage->getRenderedIcon($iconId);

        $this->assertSame($contents, $result);
    }

    /**
     * Tests the getRenderedIconFileName method.
     * @throws ReflectionException
     * @covers ::getRenderedIconFileName
     */
    public function testGetRenderedIconFileName(): void
    {
        $iconId = 'abc';
        $expectedResult = 'icons/abc.png';

        $storage = $this->createMockedStorage();
        $result = $this->invokeMethod($storage, 'getRenderedIconFileName', $iconId);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * Tests the save method.
     * @covers ::save
     */
    public function testSave(): void
    {
        $serializedData = 'abc';

        /* @var Combination&MockObject $combination */
        $combination = $this->createMock(Combination::class);

        $this->serializer->expects($this->once())
                         ->method('serialize')
                         ->with($this->identicalTo($combination), $this->identicalTo('json'))
                         ->willReturn($serializedData);

        $this->zipArchive->expects($this->once())
                         ->method('addFromString')
                         ->with($this->identicalTo('data.json'), $this->identicalTo($serializedData));

        $storage = $this->createMockedStorage();
        $storage->save($combination);
        // Unable to assert fileName, cannot be assigned.
    }

    /**
     * Tests the load method.
     * @covers ::load
     */
    public function testLoad(): void
    {
        $serializedData = 'abc';

        /* @var Combination&MockObject $combination */
        $combination = $this->createMock(Combination::class);

        $this->zipArchive->expects($this->once())
                         ->method('getFromName')
                         ->with($this->identicalTo('data.json'))
                         ->willReturn($serializedData);

        $this->serializer->expects($this->once())
                         ->method('deserialize')
                         ->with(
                             $this->identicalTo($serializedData),
                             $this->identicalTo(Combination::class),
                             $this->identicalTo('json')
                         )
                         ->willReturn($combination);

        $storage = $this->createMockedStorage();
        $result = $storage->load();

        $this->assertSame($combination, $result);
    }

    /**
     * Tests the load method.
     * @covers ::load
     */
    public function testLoadWithoutFile(): void
    {
        $expectedResult = new Combination();

        $this->zipArchive->expects($this->once())
                         ->method('getFromName')
                         ->with($this->identicalTo('data.json'))
                         ->willReturn(false);

        $this->serializer->expects($this->never())
                         ->method('deserialize');

        $storage = $this->createMockedStorage();
        $result = $storage->load();

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests the load method.
     * @covers ::load
     */
    public function testLoadWithSerializerException(): void
    {
        $serializedData = 'abc';
        $expectedResult = new Combination();

        $this->zipArchive->expects($this->once())
                         ->method('getFromName')
                         ->with($this->identicalTo('data.json'))
                         ->willReturn($serializedData);

        $this->serializer->expects($this->once())
                         ->method('deserialize')
                         ->with(
                             $this->identicalTo($serializedData),
                             $this->identicalTo(Combination::class),
                             $this->identicalTo('json')
                         )
                         ->willThrowException($this->createMock(Exception::class));

        $storage = $this->createMockedStorage();
        $result = $storage->load();

        $this->assertEquals($expectedResult, $result);
    }
}
