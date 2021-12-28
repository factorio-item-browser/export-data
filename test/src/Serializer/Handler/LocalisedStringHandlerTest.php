<?php

declare(strict_types=1);

namespace FactorioItemBrowserTest\ExportData\Serializer\Handler;

use FactorioItemBrowser\ExportData\Serializer\Handler\LocalisedStringHandler;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface;
use PHPUnit\Framework\TestCase;

/**
 * The PHPUnit test of the LocalisedStringHandler class.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 * @covers \FactorioItemBrowser\ExportData\Serializer\Handler\LocalisedStringHandler
 */
class LocalisedStringHandlerTest extends TestCase
{
    public function testGetSubscribingMethods(): void
    {
        $result = LocalisedStringHandler::getSubscribingMethods();
        $this->assertCount(2, $result);
    }

    public function testSerialize(): void
    {
        $value = ['abc', 'def'];
        $visitor = $this->createMock(SerializationVisitorInterface::class);

        $instance = new LocalisedStringHandler();
        $result = $instance->serialize($visitor, $value);

        $this->assertSame($value, $result);
    }

    public function testDeserialize(): void
    {
        $data = ['abc', 'def'];
        $visitor = $this->createMock(DeserializationVisitorInterface::class);

        $instance = new LocalisedStringHandler();
        $result = $instance->deserialize($visitor, $data);

        $this->assertSame($data, $result);
    }
}
