<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Serializer\Handler;

use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface;

/**
 * The handler for the localised strings.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class LocalisedStringHandler implements SubscribingHandlerInterface
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
                'type' => 'localisedString',
                'method' => 'serialize',
            ],
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'localisedString',
                'method' => 'deserialize',
            ],
        ];
    }

    public function serialize(SerializationVisitorInterface $visitor, mixed $value): mixed
    {
        return $value;
    }

    public function deserialize(DeserializationVisitorInterface $visitor, mixed $data): mixed
    {
        return $data;
    }
}
