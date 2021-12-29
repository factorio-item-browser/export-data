<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Serializer\Construction;

use FactorioItemBrowser\ExportData\ExportData;
use FactorioItemBrowser\ExportData\Storage\Storage;
use JMS\Serializer\Construction\ObjectConstructorInterface;
use JMS\Serializer\Construction\UnserializeObjectConstructor;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;

/**
 * The object constructor paying special attention to ExportData instances.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class ObjectConstructor implements ObjectConstructorInterface
{
    /**
     * @param DeserializationVisitorInterface $visitor
     * @param ClassMetadata $metadata
     * @param mixed $data
     * @param array<mixed> $type
     * @param DeserializationContext $context
     * @return object|null
     */
    public function construct(
        DeserializationVisitorInterface $visitor,
        ClassMetadata $metadata,
        mixed $data,
        array $type,
        DeserializationContext $context
    ): ?object {
        if ($metadata->name === ExportData::class) {
            /** @var Storage $storage */
            $storage = $context->getAttribute(Storage::class);
            return new ExportData($storage, '');
        }

        $className = $metadata->name;
        return new $className();
    }
}
