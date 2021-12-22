<?php

declare(strict_types=1);

/**
 * The configuration of the export data dependencies.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace FactorioItemBrowser\ExportData;

use BluePsyduck\JmsSerializerFactory\JmsSerializerFactory;
use BluePsyduck\LaminasAutoWireFactory\AutoWireFactory;
use BluePsyduck\LaminasAutoWireFactory\AutoWireUtils;
use FactorioItemBrowser\ExportData\Constant\ConfigKey;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerInterface;

return [
    'dependencies' => [
        'factories'  => [
            ExportDataService::class => AutoWireFactory::class,

            Serializer\Construction\ObjectConstructor::class => AutoWireFactory::class,
            Serializer\Handler\ChunkedCollectionHandler::class => AutoWireFactory::class,

            Storage\StorageFactory::class => AutoWireFactory::class,

            // 3rd-party dependencies
            IdenticalPropertyNamingStrategy::class => AutoWireFactory::class,

            // Auto-wire helpers
            SerializerInterface::class . ' $exportDataSerializer' => new JmsSerializerFactory(ConfigKey::MAIN, ConfigKey::SERIALIZER),
            'string $exportDataWorkingDirectory' => AutoWireUtils::readConfig(ConfigKey::MAIN, ConfigKey::WORKING_DIRECTORY),
        ],
    ],
];
