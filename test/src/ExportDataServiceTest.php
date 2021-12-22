<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData;

use BluePsyduck\TestHelper\ReflectionTrait;
use Exception;
use FactorioItemBrowser\ExportData\ExportData;
use FactorioItemBrowser\ExportData\ExportDataService;
use FactorioItemBrowser\ExportData\Storage\Storage;
use FactorioItemBrowser\ExportData\Storage\StorageFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the ExportDataService class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\ExportDataService
 */
class ExportDataServiceTest extends TestCase
{
    use ReflectionTrait;

    /** @var StorageFactory&MockObject */
    private StorageFactory $storageFactory;
    /** @var Storage&MockObject */
    private Storage $storage;
    private string $combinationId = 'abc';

    protected function setUp(): void
    {
        $this->storageFactory = $this->createMock(StorageFactory::class);
        $this->storage = $this->createMock(Storage::class);
    }

    private function createInstance(): ExportDataService
    {
        $this->storageFactory->expects($this->any())
                             ->method('createForCombination')
                             ->with($this->identicalTo($this->combinationId))
                             ->willReturn($this->storage);

        return new ExportDataService($this->storageFactory);
    }

    /**
     * @throws ReflectionException
     */
    public function testConstruct(): void
    {
        $instance = $this->createInstance();

        $this->assertSame($this->storageFactory, $this->extractProperty($instance, 'storageFactory'));
    }

    public function testCreateExport(): void
    {
        $expectedResult = new ExportData($this->storage, $this->combinationId);

        $this->storage->expects($this->once())
                      ->method('remove');

        $instance = $this->createInstance();
        $result = $instance->createExport($this->combinationId);

        $this->assertEquals($expectedResult, $result);
    }

    public function testLoadExport(): void
    {
        $exportData = $this->createMock(ExportData::class);

        $this->storage->expects($this->once())
                      ->method('readData')
                      ->with($this->identicalTo('meta'), $this->identicalTo(ExportData::class))
                      ->willReturn($exportData);

        $instance = $this->createInstance();
        $result = $instance->loadExport($this->combinationId);

        $this->assertSame($exportData, $result);
    }

    public function testLoadExportWithException(): void
    {
        $expectedResult = new ExportData($this->storage, $this->combinationId);

        $this->storage->expects($this->once())
                      ->method('readData')
                      ->with($this->identicalTo('meta'), $this->identicalTo(ExportData::class))
                      ->willThrowException($this->createMock(Exception::class));

        $instance = $this->createInstance();
        $result = $instance->loadExport($this->combinationId);

        $this->assertEquals($expectedResult, $result);
    }

    public function testPersistExport(): void
    {
        $fileName = 'def';
        $exportData = new ExportData($this->storage, $this->combinationId);

        $this->storage->expects($this->once())
                      ->method('writeData')
                      ->with($this->identicalTo('meta'), $this->identicalTo($exportData));
        $this->storage->expects($this->once())
                      ->method('getFileName')
                      ->willReturn($fileName);

        $instance = $this->createInstance();
        $result = $instance->persistExport($exportData);
        $this->assertSame($fileName, $result);
    }

    public function testRemoveExport(): void
    {
        $this->storage->expects($this->once())
                      ->method('remove');

        $instance = $this->createInstance();
        $instance->removeExport($this->combinationId);
    }
}
