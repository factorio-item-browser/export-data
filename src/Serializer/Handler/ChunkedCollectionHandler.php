<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Serializer\Handler;

use FactorioItemBrowser\ExportData\Collection\ChunkedCollection;
use FactorioItemBrowser\ExportData\Storage\Storage;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;

/**
 * The handler for the chunked collection.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ChunkedCollectionHandler implements SubscribingHandlerInterface
{
    /**
     * @return array<mixed>
     */
    public static function getSubscribingMethods(): array
    {
        return [
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
    }

    /**
     * @param JsonSerializationVisitor $visitor
     * @param mixed $value
     * @return int
     */
    public static function serialize(JsonSerializationVisitor $visitor, $value): int
    {
        if ($value instanceof ChunkedCollection) {
            $value->persist();
            return $value->count();
        }

        return 0;
    }

    /**
     * @param JsonDeserializationVisitor $visitor
     * @param mixed $data
     * @param array<mixed> $type
     * @param Context $context
     * @return ChunkedCollection<object>
     */
    public static function deserialize(
        JsonDeserializationVisitor $visitor,
        $data,
        array $type,
        Context $context
    ): ChunkedCollection {
        $storage = $context->getAttribute(Storage::class);
        $itemClass = $type['params'][0]['name'] ?? '';
        $count = (int) $data;

        return new ChunkedCollection($storage, $itemClass, $count);
    }
}
