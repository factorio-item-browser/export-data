<?php

declare(strict_types=1);

namespace FactorioItemBrowser\ExportData\Helper;

use BluePsyduck\LaminasAutoWireFactory\Attribute\Alias;
use FactorioItemBrowser\ExportData\Constant\SerializationGroup;
use FactorioItemBrowser\ExportData\Constant\ServiceName;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Ramsey\Uuid\Uuid;

/**
 * The class helping with hashing entities to a UUID.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class HashCalculator
{
    public function __construct(
        #[Alias(ServiceName::SERIALIZER)]
        private readonly SerializerInterface $serializer,
    ) {
    }

    /**
     * Hashes the specified entity.
     * @param object $entity
     * @return string
     */
    public function hashEntity(object $entity): string
    {
        $context = SerializationContext::create()->setGroups([SerializationGroup::HASH]);
        $data = $this->serializer->serialize($entity, 'json', $context);
        return Uuid::fromString(hash('md5', $data))->toString();
    }
}
