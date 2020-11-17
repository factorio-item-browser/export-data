<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Storage;

use FactorioItemBrowser\ExportData\Storage\Storage;
use FactorioItemBrowser\ExportData\Storage\StorageFactory;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the StorageFactory class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @coversDefaultClass \FactorioItemBrowser\ExportData\Storage\StorageFactory
 */
class StorageFactoryTest extends TestCase
{
    /**
     * @covers ::<public>
     */
    public function testCreateForCombination(): void
    {
        $serializer = $this->createMock(SerializerInterface::class);
        $workingDirectory = 'abc';
        $combinationId1 = 'def';
        $combinationId2 = 'ghi';

        $expectedStorage1 = new Storage($serializer, 'abc/def.zip');
        $expectedStorage2 = new Storage($serializer, 'abc/ghi.zip');

        $instance = new StorageFactory($serializer, $workingDirectory);

        $result1 = $instance->createForCombination($combinationId1);
        $this->assertEquals($expectedStorage1, $result1);

        $result2 = $instance->createForCombination($combinationId1);
        $this->assertSame($result1, $result2);

        $result3 = $instance->createForCombination($combinationId2);
        $this->assertEquals($expectedStorage2, $result3);
    }
}
