<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Storage;

use BluePsyduck\TestHelper\ReflectionTrait;
use Exception;
use FactorioItemBrowser\ExportData\Entity\Combination;
use FactorioItemBrowser\ExportData\Storage\ZipArchiveStorage;
use JMS\Serializer\SerializerInterface;
use org\bovigo\vfs\vfsStream;
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
        $fileName = 'abc';

        $storage = new ZipArchiveStorage($this->serializer, $fileName);

        $this->assertSame($this->serializer, $this->extractProperty($storage, 'serializer'));
        $this->assertSame($fileName, $this->extractProperty($storage, 'fileName'));
    }

    /**
     * Tests the destructor.
     * @throws ReflectionException
     * @covers ::__destruct
     */
    public function testDestruct(): void
    {
        /* @var ZipArchive&MockObject $zipArchive */
        $zipArchive = $this->createMock(ZipArchive::class);

        /* @var ZipArchiveStorage&MockObject $storage */
        $storage = $this->getMockBuilder(ZipArchiveStorage::class)
                        ->onlyMethods(['closeZipArchive'])
                        ->setConstructorArgs([$this->serializer, 'abc'])
                        ->getMock();
        $this->injectProperty($storage, 'zipArchive', $zipArchive);

        $storage->expects($this->once())
                ->method('closeZipArchive');

        $storage->__destruct();
    }

    /**
     * Tests the getZipArchive method.
     * @throws ReflectionException
     * @covers ::getZipArchive
     */
    public function testGetZipArchive(): void
    {
        $fileName = realpath(__DIR__ . '/../../asset') . '/temp.zip';

        $storage = new ZipArchiveStorage($this->serializer, $fileName);

        $result = $this->invokeMethod($storage, 'getZipArchive');

        $this->assertInstanceOf(ZipArchive::class, $result);
        $this->assertSame($fileName, $result->filename);
    }

    /**
     * Tests the getZipArchive method.
     * @throws ReflectionException
     * @covers ::getZipArchive
     */
    public function testGetZipArchiveWithExistingArchive(): void
    {
        $fileName = realpath(__DIR__ . '/../../asset') . '/temp.zip';

        /* @var ZipArchive&MockObject $zipArchive */
        $zipArchive = $this->createMock(ZipArchive::class);

        $storage = new ZipArchiveStorage($this->serializer, $fileName);
        $this->injectProperty($storage, 'zipArchive', $zipArchive);

        $result = $this->invokeMethod($storage, 'getZipArchive');

        $this->assertSame($zipArchive, $result);
    }

    /**
     * Tests the closeZipArchive method.
     * @throws ReflectionException
     * @covers ::closeZipArchive
     */
    public function testCloseZipArchive(): void
    {
        /* @var ZipArchive&MockObject $zipArchive */
        $zipArchive = $this->createMock(ZipArchive::class);
        $zipArchive->expects($this->once())
                   ->method('close');

        $storage = new ZipArchiveStorage($this->serializer, 'foo');
        $this->injectProperty($storage, 'zipArchive', $zipArchive);

        $this->invokeMethod($storage, 'closeZipArchive');

        $this->assertNull($this->extractProperty($storage, 'zipArchive'));
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

        /* @var ZipArchive&MockObject $zipArchive */
        $zipArchive = $this->createMock(ZipArchive::class);
        $zipArchive->expects($this->once())
                   ->method('addFromString')
                   ->with($this->identicalTo($iconFileName), $this->identicalTo($contents));

        /* @var ZipArchiveStorage&MockObject $storage */
        $storage = $this->getMockBuilder(ZipArchiveStorage::class)
                        ->onlyMethods(['getZipArchive', 'getRenderedIconFileName'])
                        ->setConstructorArgs([$this->serializer, 'abc'])
                        ->getMock();
        $storage->expects($this->once())
                ->method('getZipArchive')
                ->willReturn($zipArchive);
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

        /* @var ZipArchive&MockObject $zipArchive */
        $zipArchive = $this->createMock(ZipArchive::class);
        $zipArchive->expects($this->once())
                   ->method('getFromName')
                   ->with($this->identicalTo($iconFileName))
                   ->willReturn($contents);

        /* @var ZipArchiveStorage&MockObject $storage */
        $storage = $this->getMockBuilder(ZipArchiveStorage::class)
                        ->onlyMethods(['getZipArchive', 'getRenderedIconFileName'])
                        ->setConstructorArgs([$this->serializer, 'abc'])
                        ->getMock();
        $storage->expects($this->once())
                ->method('getZipArchive')
                ->willReturn($zipArchive);
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

        $storage = new ZipArchiveStorage($this->serializer, 'foo');
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

        /* @var ZipArchive&MockObject $zipArchive */
        $zipArchive = $this->createMock(ZipArchive::class);
        $zipArchive->expects($this->once())
                   ->method('addFromString')
                   ->with($this->identicalTo('data.json'), $this->identicalTo($serializedData));

        /* @var ZipArchiveStorage&MockObject $storage */
        $storage = $this->getMockBuilder(ZipArchiveStorage::class)
                        ->onlyMethods(['getZipArchive'])
                        ->setConstructorArgs([$this->serializer, 'foo'])
                        ->getMock();
        $storage->expects($this->once())
                ->method('getZipArchive')
                ->willReturn($zipArchive);

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

        /* @var ZipArchive&MockObject $zipArchive */
        $zipArchive = $this->createMock(ZipArchive::class);
        $zipArchive->expects($this->once())
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

        /* @var ZipArchiveStorage&MockObject $storage */
        $storage = $this->getMockBuilder(ZipArchiveStorage::class)
                        ->onlyMethods(['getZipArchive'])
                        ->setConstructorArgs([$this->serializer, 'foo'])
                        ->getMock();
        $storage->expects($this->once())
                ->method('getZipArchive')
                ->willReturn($zipArchive);

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

        /* @var ZipArchive&MockObject $zipArchive */
        $zipArchive = $this->createMock(ZipArchive::class);
        $zipArchive->expects($this->once())
                   ->method('getFromName')
                   ->with($this->identicalTo('data.json'))
                   ->willReturn(false);

        $this->serializer->expects($this->never())
                         ->method('deserialize');

        /* @var ZipArchiveStorage&MockObject $storage */
        $storage = $this->getMockBuilder(ZipArchiveStorage::class)
                        ->onlyMethods(['getZipArchive'])
                        ->setConstructorArgs([$this->serializer, 'foo'])
                        ->getMock();
        $storage->expects($this->once())
                ->method('getZipArchive')
                ->willReturn($zipArchive);

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

        /* @var ZipArchive&MockObject $zipArchive */
        $zipArchive = $this->createMock(ZipArchive::class);
        $zipArchive->expects($this->once())
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


        /* @var ZipArchiveStorage&MockObject $storage */
        $storage = $this->getMockBuilder(ZipArchiveStorage::class)
                        ->onlyMethods(['getZipArchive'])
                        ->setConstructorArgs([$this->serializer, 'foo'])
                        ->getMock();
        $storage->expects($this->once())
                ->method('getZipArchive')
                ->willReturn($zipArchive);

        $result = $storage->load();

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests the remove method.
     * @covers ::remove
     */
    public function testRemove(): void
    {
        $directory = vfsStream::setup('root');
        $directory->addChild(vfsStream::newFile('foo'));
        $fileName = vfsStream::url('root/foo');

        /* @var ZipArchiveStorage&MockObject $storage */
        $storage = $this->getMockBuilder(ZipArchiveStorage::class)
                        ->onlyMethods(['closeZipArchive'])
                        ->setConstructorArgs([$this->serializer, $fileName])
                        ->getMock();
        $storage->expects($this->once())
                ->method('closeZipArchive');

        $this->assertTrue($directory->hasChild('foo'));

        $storage->remove();

        $this->assertFalse($directory->hasChild('foo'));
    }
}
