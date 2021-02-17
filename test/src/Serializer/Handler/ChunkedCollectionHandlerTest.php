<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Serializer\Handler;

use FactorioItemBrowser\ExportData\Collection\ChunkedCollection;
use FactorioItemBrowser\ExportData\Serializer\Handler\ChunkedCollectionHandler;
use FactorioItemBrowser\ExportData\Storage\Storage;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the ChunkedCollectionHandler class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\Serializer\Handler\ChunkedCollectionHandler
 */
class ChunkedCollectionHandlerTest extends TestCase
{
    public function testGetSubscribingMethods(): void
    {
        $expectedResult = [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'ChunkedCollection',
                'method' => 'serialize',
            ],
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'ChunkedCollection',
                'method' => 'deserialize',
            ],
        ];

        $result = ChunkedCollectionHandler::getSubscribingMethods();

        $this->assertSame($expectedResult, $result);
    }

    public function testSerialize(): void
    {
        $visitor = new JsonSerializationVisitor();
        $expectedResult = 42;

        $value = $this->getMockBuilder(ChunkedCollection::class)
                      ->onlyMethods(['persist', 'count'])
                      ->disableOriginalConstructor()
                      ->getMock();
        $value->expects($this->once())
              ->method('persist');
        $value->expects($this->once())
              ->method('count')
              ->willReturn(42);

        $result = ChunkedCollectionHandler::serialize($visitor, $value);
        $this->assertSame($expectedResult, $result);
    }

    public function testSerializeWithoutCollection(): void
    {
        $visitor = new JsonSerializationVisitor();

        $value = 42;
        $expectedResult = 0;

        $result = ChunkedCollectionHandler::serialize($visitor, $value);
        $this->assertSame($expectedResult, $result);
    }

    public function testDeserialize(): void
    {
        $visitor = new JsonDeserializationVisitor();
        $storage = $this->createMock(Storage::class);

        $context = new DeserializationContext();
        $context->setAttribute(Storage::class, $storage);

        $type = [
            'params' => [
                ['name' => self::class],
            ]
        ];
        $data = 42;

        $expectedResult = new ChunkedCollection($storage, self::class, 42);

        $result = ChunkedCollectionHandler::deserialize($visitor, $data, $type, $context);
        $this->assertEquals($expectedResult, $result);
    }
}
