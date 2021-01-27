<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Serializer\Construction;

use FactorioItemBrowser\ExportData\ExportData;
use FactorioItemBrowser\ExportData\Serializer\Construction\ObjectConstructor;
use FactorioItemBrowser\ExportData\Storage\Storage;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * The PHPUnit test of the ObjectConstructor class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\Serializer\Construction\ObjectConstructor
 */
class ObjectConstructorTest extends TestCase
{
    /**
     * @return array<mixed>
     */
    public function provideConstruct(): array
    {
        $storage = $this->createMock(Storage::class);

        return [
            [ExportData::class, $storage, new ExportData($storage, '')],
            [stdClass::class, $storage, new stdClass()],
        ];
    }

    /**
     * @dataProvider provideConstruct
     * @param string $name
     * @param Storage $storage
     * @param object|null $expectedResult
     */
    public function testConstruct(string $name, Storage $storage, ?object $expectedResult): void
    {
        $classMetadata = $this->createMock(ClassMetadata::class);
        $classMetadata->name = $name;

        $context = $this->createMock(DeserializationContext::class);
        $context->expects($this->any())
                ->method('getAttribute')
                ->with($this->identicalTo(Storage::class))
                ->willReturn($storage);


        $instance = new ObjectConstructor();
        $result = $instance->construct(
            $this->createMock(DeserializationVisitorInterface::class),
            $classMetadata,
            null,
            [],
            $context,
        );

        $this->assertEquals($expectedResult, $result);
    }
}
