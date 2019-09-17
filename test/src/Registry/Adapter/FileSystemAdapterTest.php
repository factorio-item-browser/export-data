<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Registry\Adapter;

use BluePsyduck\TestHelper\ReflectionTrait;
use FactorioItemBrowser\ExportData\Exception\ExportDataException;
use FactorioItemBrowser\ExportData\Registry\Adapter\FileSystemAdapter;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the FileSystemAdapter class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Registry\Adapter\FileSystemAdapter
 */
class FileSystemAdapterTest extends TestCase
{
    use ReflectionTrait;

    /**
     * Tests the constructing.
     * @covers ::__construct
     * @throws ReflectionException
     */
    public function testConstruct(): void
    {
        $directory = 'abc';

        $adapter = new FileSystemAdapter($directory);
        $this->assertSame($directory, $this->extractProperty($adapter, 'directory'));
    }

    /**
     * Provides the data for the save test.
     * @return array
     */
    public function provideSave(): array
    {
        return [
            [0775, false],
            [0000, true],
        ];
    }


    /**
     * Tests the save method.
     * @param int $filePermission
     * @param bool $expectException
     * @throws ExportDataException
     * @covers ::save
     * @dataProvider provideSave
     */
    public function testSave(int $filePermission, bool $expectException): void
    {
        $directory = vfsStream::setup('root');
        $directory->addChild(vfsStream::newFile('foo', $filePermission));

        $namespace = 'def';
        $hash = 'ghi';
        $content = 'jkl';
        $fileName = $directory->getChild('foo')->url();
        $expectedDirectory = dirname($fileName);

        if ($expectException) {
            $this->expectException(ExportDataException::class);
        }

        /* @var FileSystemAdapter|MockObject $adapter */
        $adapter = $this->getMockBuilder(FileSystemAdapter::class)
                        ->setMethods(['getFileName', 'ensureDirectory'])
                        ->disableOriginalConstructor()
                        ->getMock();
        $adapter->expects($this->once())
                ->method('getFileName')
                ->with($namespace, $hash)
                ->willReturn($fileName);
        $adapter->expects($this->once())
                ->method('ensureDirectory')
                ->with($expectedDirectory);

        $adapter->save($namespace, $hash, $content);

        $this->assertTrue($directory->hasChild('foo'));
        if (!$expectException) {
            $this->assertSame($content, file_get_contents($fileName));
        }
    }

    /**
     * Provides the data for the load test.
     * @return array
     */
    public function provideLoad(): array
    {
        return [
            ['bar', 0775, 'bar'],
            ['bar', 0000, null],
            [null, 0775, null],
        ];
    }

    /**
     * Tests the load method.
     * @param string|null $content
     * @param int $filePermission
     * @param string|null $expectedResult
     * @covers ::load
     * @dataProvider provideLoad
     */
    public function testLoad(?string $content, int $filePermission, ?string $expectedResult): void
    {
        $directory = vfsStream::setup('root', $filePermission);
        if ($content !== null) {
            $file = vfsStream::newFile('foo', 0775);
            $directory->addChild($file);
            file_put_contents($file->url(), $content);
            $file->chmod($filePermission);
        }

        $namespace = 'def';
        $hash = 'ghi';
        $fileName = vfsStream::url('root/foo');

        /* @var FileSystemAdapter|MockObject $adapter */
        $adapter = $this->getMockBuilder(FileSystemAdapter::class)
                        ->setMethods(['getFileName'])
                        ->disableOriginalConstructor()
                        ->getMock();
        $adapter->expects($this->once())
                ->method('getFileName')
                ->with($namespace, $hash)
                ->willReturn($fileName);

        $result = $adapter->load($namespace, $hash);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Provides the data for the delete test.
     * @return array
     */
    public function provideDelete(): array
    {
        return [
            [true],
            [false],
        ];
    }

    /**
     * Tests the delete method.
     * @param bool $withFile
     * @covers ::delete
     * @dataProvider provideDelete
     */
    public function testDelete(bool $withFile): void
    {
        $directory = vfsStream::setup('root');
        if ($withFile) {
            $directory->addChild(vfsStream::newFile('foo'));
        }

        $namespace = 'abc';
        $hash = 'def';
        $fileName = vfsStream::url('root/foo');

        /* @var FileSystemAdapter|MockObject $adapter */
        $adapter = $this->getMockBuilder(FileSystemAdapter::class)
                        ->setMethods(['getFileName'])
                        ->disableOriginalConstructor()
                        ->getMock();
        $adapter->expects($this->once())
                ->method('getFileName')
                ->with($namespace, $hash)
                ->willReturn($fileName);

        $this->assertSame($withFile, $directory->hasChild('foo'));
        $adapter->delete($namespace, $hash);
        $this->assertFalse($directory->hasChild('foo'));
    }

    /**
     * Tests the getFileName method.
     * @covers ::getFileName
     * @throws ReflectionException
     */
    public function testGetFileName(): void
    {
        $directory = 'abc';
        $namespace = 'def';
        $hash = 'ab12cd34';
        $expectedResult = 'abc/def/ab/ab12cd34';

        $adapter = new FileSystemAdapter($directory);
        $result = $this->invokeMethod($adapter, 'getFileName', $namespace, $hash);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Provides the data for the ensureDirectory test.
     * @return array
     */
    public function provideEnsureDirectory(): array
    {
        return [
            [0775, 0775, false, true],
            [0775, null, false, true],
            [0775, 0000, true, false],
            [0000, null, true, false],
        ];
    }

    /**
     * Tests the ensureDirectory method.
     * @param int $parentDirectoryPermission
     * @param int|null $directoryPermission
     * @param bool $expectException
     * @param bool $expectDirectory
     * @throws ReflectionException
     * @covers ::ensureDirectory
     * @dataProvider provideEnsureDirectory
     */
    public function testEnsureDirectory(
        int $parentDirectoryPermission,
        ?int $directoryPermission,
        bool $expectException,
        bool $expectDirectory
    ): void {
        $vfs = vfsStream::setup('root', $parentDirectoryPermission);
        $directory = vfsStream::url('root/abc');
        if ($directoryPermission !== null) {
            $vfs->addChild(vfsStream::newDirectory('abc', $directoryPermission));
        }

        if ($expectException) {
            $this->expectException(ExportDataException::class);
        }

        $adapter = new FileSystemAdapter('foo');
        $this->invokeMethod($adapter, 'ensureDirectory', $directory);
        $this->assertSame($expectDirectory, $vfs->hasChild('abc'));
    }

    /**
     * Tests the getAllHashes method.
     * @covers ::getAllHashes
     */
    public function testGetAllHashes(): void
    {
        $directory = vfsStream::url('root');
        $namespace = 'abc';

        vfsStream::setup('root', 0775, [
            'abc' => [
                'def' => [
                    'ghi' => 'foo',
                    'jkl' => 'bar'
                ],
                'mno' => [
                    'pqr' => 'baz'
                ],
            ],
            'stu' => [
                'vwx' => [
                    'yz' => 'fail'
                ],
            ],
        ]);
        $expectedResult = ['ghi', 'jkl', 'pqr'];

        $adapter = new FileSystemAdapter($directory);
        $result = $adapter->getAllHashes($namespace);
        $this->assertEquals($expectedResult, $result);
    }
}
