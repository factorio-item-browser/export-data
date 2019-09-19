<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData;

use BluePsyduck\TestHelper\ReflectionTrait;
use FactorioItemBrowser\ExportData\Entity\Combination;
use FactorioItemBrowser\ExportData\ExportData;
use FactorioItemBrowser\ExportData\ExportDataService;
use FactorioItemBrowser\ExportData\Storage\StorageFactoryInterface;
use FactorioItemBrowser\ExportData\Storage\StorageInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * The PHPUnit test of the ExportDataService class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\ExportDataService
 */
class ExportDataServiceTest extends TestCase
{
    use ReflectionTrait;

    /**
     * The mocked storage factory.
     * @var StorageFactoryInterface&MockObject
     */
    protected $storageFactory;

    /**
     * Sets up the test case.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->storageFactory = $this->createMock(StorageFactoryInterface::class);
    }

    /**
     * Tests the constructing.
     * @throws ReflectionException
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $service = new ExportDataService($this->storageFactory);

        $this->assertSame($this->storageFactory, $this->extractProperty($service, 'storageFactory'));
    }

    /**
     * Tests the createExport method.
     * @covers ::createExport
     */
    public function testCreateExport(): void
    {
        $combinationHash = 'abc';

        /* @var StorageInterface&MockObject $storage */
        $storage = $this->createMock(StorageInterface::class);

        $expectedResult = new ExportData((new Combination())->setHash('abc'), $storage);

        $this->storageFactory->expects($this->once())
                             ->method('createForCombination')
                             ->with($this->equalTo($combinationHash))
                             ->willReturn($storage);

        $service = new ExportDataService($this->storageFactory);
        $result = $service->createExport($combinationHash);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Tests the loadExport method.
     * @covers ::loadExport
     */
    public function testLoadExport(): void
    {
        $combinationHash = 'abc';

        /* @var Combination&MockObject $combination */
        $combination = $this->createMock(Combination::class);

        /* @var StorageInterface&MockObject $storage */
        $storage = $this->createMock(StorageInterface::class);
        $storage->expects($this->once())
                ->method('load')
                ->willReturn($combination);

        $expectedResult = new ExportData($combination, $storage);

        $this->storageFactory->expects($this->once())
                             ->method('createForCombination')
                             ->with($this->identicalTo($combinationHash))
                             ->willReturn($storage);

        $service = new ExportDataService($this->storageFactory);
        $result = $service->loadExport($combinationHash);

        $this->assertEquals($expectedResult, $result);
    }
}
