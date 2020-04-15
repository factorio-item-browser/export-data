<?php

declare(strict_types=1);

/**
 * The configuration of the export data dependencies.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace FactorioItemBrowser\ExportData;

use BluePsyduck\LaminasAutoWireFactory\AutoWireFactory;
use FactorioItemBrowser\ExportData\Constant\ConfigKey;
use JMS\Serializer\SerializerInterface;

use function BluePsyduck\LaminasAutoWireFactory\readConfig;

return [
    'dependencies' => [
        'aliases' => [
            Storage\StorageFactoryInterface::class => Storage\StorageFactory::class,
        ],
        'factories'  => [
            ExportDataService::class => AutoWireFactory::class,
            Storage\StorageFactory::class => AutoWireFactory::class,

            // Auto-wire helpers
            SerializerInterface::class . ' $exportDataSerializer' => Serializer\SerializerFactory::class,
            'string $exportDataWorkingDirectory' => readConfig(ConfigKey::PROJECT, ConfigKey::EXPORT_DATA, ConfigKey::WORKING_DIRECTORY),
        ],
    ],
];
