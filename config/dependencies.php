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
use FactorioItemBrowser\ExportData\Constant\ConfigKey;
use FactorioItemBrowser\ExportData\Constant\ServiceName;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;

return [
    'dependencies' => [
        'factories'  => [
            ExportDataService::class => AutoWireFactory::class,

            Helper\HashCalculator::class => AutoWireFactory::class,

            Serializer\Construction\ObjectConstructor::class => AutoWireFactory::class,
            Serializer\Handler\ChunkedCollectionHandler::class => AutoWireFactory::class,
            Serializer\Handler\LocalisedStringHandler::class => AutoWireFactory::class,

            Storage\StorageFactory::class => AutoWireFactory::class,

            ServiceName::SERIALIZER => new JmsSerializerFactory(ConfigKey::MAIN, ConfigKey::SERIALIZER),

            // 3rd-party dependencies
            IdenticalPropertyNamingStrategy::class => AutoWireFactory::class,
        ],
    ],
];
